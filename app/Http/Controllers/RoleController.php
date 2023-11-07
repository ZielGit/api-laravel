<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function store(StoreRequest $request)
    {
        $role = Role::create($request->all());
        $role->permissions()->sync($request->get('permissions'));
        $response = [
            'message' => 'Role created successfully',
            'role' => $role
        ];
        return response()->json($response);
    }

    public function show(Role $role)
    {
        $role->load('permissions');
        return response()->json($role);
    }

    public function update(UpdateRequest $request, Role $role)
    {
        $role->update($request->all());
        $role->permissions()->sync($request->permissions);
        $response = [
            'message' => 'Role updated successfully',
            'role' => $role
        ];
        return response()->json($response);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        $response = [
            'message' => 'Role deleted successfully',
            'role' => $role
        ];
        return response()->json($response);
    }

    public function permissions()
    {
        $permissions = Permission::all();
        return response()->json($permissions);
    }
}
