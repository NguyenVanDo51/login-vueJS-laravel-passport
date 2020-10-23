<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('pages.permissions', [
            'permissions' => Permission::all()
        ]);
    }

    public function store(Request $request)
    {
        $permission = Permission::query()->pluck('name');

        $data = $request->validate([
            'permission' => ['required', Rule::notIn($permission)]
        ]);

        Permission::create(['name' => $data['permission']]);

        return back();
    }

    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();
        } catch (Exception $e) {
        }

        return back();
    }
}
