<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $data = [
            'message' => 'Registered user successfully',
            'user' => $user,
            'access_token' => $token,
            "token_type" => "Bearer"
        ];
        
        return response()->json($data);
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(["message" => "Unauthorized", 401]);
        }
        
        $user = User::where('email', $request['email'])->firstOrfail();
        $token = $user->createToken('auth_token')->plainTextToken;

        // Obtén los roles y permisos del usuario
        $roles = $user->getRoleNames();
        $permissions = $user->getAllPermissions();

        return response()->json([
            "message" => "HI ".$user->name,
            "accessToken" => $token,
            "token_type" => "Bearer",
            "user" => $user,
            "roles" => $roles,
            "permissions" => $permissions
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            "message" => "You have successfully logged out and the token was successfully deleted"
        ];
    }
}
