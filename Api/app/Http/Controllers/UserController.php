<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Mockery\Exception;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        return view('pages.dashboard', [
            'users' => User::with('roles')->get()
        ]);
    }

    public function test()
    {
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @var RouteCollection $routes
     */
    public function show(User $user)
    {
        $permissions = $user->getPermissionNames();

        // Lay tat ca roule cua user
        $roles = $user->roles()->pluck('name');

        $allRole = Role::all();

        // Lay toan bo route
        $routes = app('router')->getRoutes();

        // Lay ten cua toan bo cac routes
        $routes = collect($routes->getRoutesByName())->keys();

        try {
            $models = Route::query()->pluck('name');
        } catch (Exception $exception) {
            logger('Exception when get routes', [
                "Exception" => $exception->getMessage()
            ]);
        }

        $data = [];
        // Mang $model la danh sach cac route da dinh nghi can phan quyen (VD: posts.index, posts.show, roles.index, ...)
        foreach ($models as $model) {
            // So sanh cac routes voi tung phan tu cua mang $models de lay het cac route cua tung model
            $data[$model] = $routes->filter(function ($value) use ($model) {
//              chi lay ra nhung route co ten bat dau la cac phan tu trong $models
                return Str::startsWith($value, $model);
            });
        }

        return view('pages.profile',
            compact('user', 'permissions', 'roles', 'allRole', 'data'));
    }

    public function store(Request $request)
    {
        // Lay ra toan bo permission tu request
        $permissions = $request->all();

        try {

            // Tim kiem user thong qua id duoc gui tu request, luu trong key 'user' cua bien $permission
            $user = User::query()->findOrFail(Arr::pull($permissions, "user"));

            // Xoa bien _token
            unset($permissions['_token'], $permissions['user']);

            // Lay toan bo key (la cac permissions ma usee duoc phan quyen)
            $permissions = array_keys($permissions);

            // Thay the '_' = '.'
            $permissions = array_map(function ($permission) {
                return str_replace('_', '.', $permission);
            }, $permissions);

            foreach ($permissions as $permission) {
                // Them moi permissions neu chua ton tai
                Permission::query()->firstOrCreate(['name' => $permission]);
            }

            // Dong bo permission cho user
            $user->syncPermissions($permissions);
        } catch (Exception $exception) {
            logger("Exception when update permission!", [
                "exception: " => $exception->getMessage()
            ]);
        }

        return redirect()->route('users.index');
    }
}
