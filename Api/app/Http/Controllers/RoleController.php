<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('pages.roles', [
            'roles' => Role::all()
        ]);
    }

    public function create(Request $request)
    {

        $roles = Role::query()->pluck('name');

        $data = $request->validate([
            'role' => ['required', Rule::notIn($roles)]
        ]);

        Role::create(['name' => $data['role']]);
        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::query()->pluck('name');

        $rolePermissions = $role->permissions()->pluck('name');

        return view('pages.edit-role', compact('role', 'permissions', 'rolePermissions'));
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();
        } catch (Exception $e) {
            logger('Error when delete role', [
                'message' => $e->getMessage()
            ]);
        }
        return redirect()->route('roles.index');
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        $role->syncPermissions($request->get('permissions'));

        return redirect()->route('roles.index');
    }
}
