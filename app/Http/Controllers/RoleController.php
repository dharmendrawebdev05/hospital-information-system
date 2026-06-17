<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }


    public function permissions(Role $role)
{
    $permissions = Permission::all();

    return view(
        'roles.permissions',
        compact('role','permissions')
    );
}


public function updatePermissions(
    Request $request,
    Role $role
)
{
    $role->syncPermissions(
        $request->permissions ?? []
    );

    return back()
        ->with('success',
        'Permissions Updated');
}


    
}