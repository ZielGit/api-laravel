<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // $request->validate([
        //     'name' =>'required',
        //     'email' =>'required|email|unique:users',
        //     'password' => 'required|confirmed'
        // ]);
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

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

    public function login(Request $request)
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
