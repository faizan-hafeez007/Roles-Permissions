<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware('permission:view users', only: ['index']),
            new Middleware('permission:edit users', only: ['edit']),
            new Middleware('permission:create users', only: ['create']),
            new Middleware('permission:delete users', only: ['destroy'])
        ];
    }
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(4);
        $roles = Role::all();
        return view('user.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Validate the request input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'roles' => 'array|nullable' // Make roles optional for this case
        ]);

        try {
            // Hash the password before saving it
            $validatedData['password'] = Hash::make($validatedData['password']);

            // Create the user
            $user = User::create($validatedData);

            // Assign roles to the user if any roles are provided
            if (isset($validatedData['roles'])) {
                $user->syncRoles($validatedData['roles']); // Use syncRoles to ensure roles are updated
            }

            return redirect()->route('user.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            // Log the exception message for debugging purposes
            Log::error('Failed to create user: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to create user.');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Use findOrFail to handle not found cases
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray(); // Get role IDs assigned to the user

        return view('user.edit', compact('user', 'roles', 'userRoles'));
    }



    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'roles' => 'array|nullable', // Make sure roles validation is here
        ]);

        try {
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];

            if (!empty($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']);
            }

            $user->save();

            // Sync roles if provided, else clear roles
            if (isset($validatedData['roles'])) {
                $user->syncRoles($validatedData['roles']);
            } else {
                $user->syncRoles([]); // Clear roles if none selected
            }

            return redirect()->route('user.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update user.');
        }
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id); // Use findOrFail to handle not found cases

        try {
            $user->delete();
            return redirect()->route('user.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            // Log the exception message for debugging purposes
            Log::error('Failed to delete user: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to delete user.');
        }
    }
}
