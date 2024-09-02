<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;


class RoleController extends Controller 
{
    // public static function middleware(): array
    // {
    //     return [

    //         new Middleware('permission:view roles', only: ['index']),
    //         new middleware('permission:view roles|role-create|role-edit|role-delete', ['only' => ['index','store']]),
    //         new Middleware('permission:edit roles', only: ['edit']),
    //         new Middleware('permission:Create roles', only: ['create']),
    //         new Middleware('permission:delete roles', only: ['destroy'])
    //     ];
    // }
    public function index()
    {
        $roles = Role::orderBy('created_at', 'desc')->paginate(2);
        return view('role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles|max:255',
            'permissions' => 'array|required',
        ]);

        // Create the role with the validated name
        $role = Role::create(['name' => $validatedData['name']]);

        // Sync permissions with the role using permission IDs
        if (!empty($validatedData['permissions'])) {
            $role->syncPermissions($validatedData['permissions']);
        }

        // Redirect with success message
        return redirect()->route('role.index')->with('success', 'Role created successfully.');
    }


    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id');

        return view('role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name,' . $id . '|max:255',
            'permissions' => 'array|required',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $validatedData['name'];
        $role->save();

        // Convert permission names to IDs
        $permissionIds = Permission::whereIn('name', $request->input('permissions'))->pluck('id');

        // Sync permissions with the role using permission IDs
        $role->syncPermissions($permissionIds);

        return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    }



    public function destroy($id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->delete();
            return redirect()->route('role.index')->with('success', 'Role deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Role not found.');
        }
    }
}
