<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware('permission:view permissions', only: ['index']),
            new Middleware('permission:edit permissions', only: ['edit']),
            new Middleware('permission:create permissions', only: ['create']),
            new Middleware('permission:delete permissions', only: ['destroy'])
        ];
    }
    public function index()
    {
        // Correct ordering and pagination
        $permissions = Permission::orderBy('created_at', 'desc')->paginate(10);

        // Passing the permissions to the view
        return view('permission.index', compact('permissions'));
    }


    public function create()
    {
        return view('permission.create');
    }

    public function store()
    {
        $validatedData = request()->validate([
            'name' => 'required|unique:permissions|max:40',
        ]);
        try {
            Permission::create($validatedData);
            return redirect()->route('permission.index')->with('success', 'Permission created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create permission.');
        }
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('permission.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);
        if ($permission) {
            $permission->name = $request->name;
            $permission->save();
            return redirect()->route('permission.index');
        } else {
            return redirect()->back()->with('error', 'Permission not found.')->abort(404);
        }
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        if ($permission) {
            $permission->delete();
            return redirect()->route('permission.index')->with('success', 'Permission deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Permission not found.');
        }
    }
}
