<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/redirect', function (Request $request) {
    $request->session()->put('state', $state = Str::random(40));

    $query = http_build_query([
        'client_id' => '91be78bc-6ded-4f42-b856-5ba15f34e668',
        'redirect_uri' => 'http://permission.test',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
    ]);

    return redirect('http://permission.test/oauth/authorize?'.$query);
});

Route::redirect('dashboard', '/');

Route::get('/', function () {
    // Lay toan bo route
    $routes = app('router')->getRoutes();

    // Lay ten cua toan bo cac routes
    $routes = collect($routes->getRoutesByName())->keys();

    $actions = \App\Models\Route::query()->pluck('name');

    $data = [];
    // Mang $model la danh sach cac route da dinh nghi can phan quyen (VD: posts.index, posts.show, roles.index, ...)
    foreach ($actions as $action) {
        $routes->each(function ($value) use ($action, &$data) {
            if (Str::contains($value, $action . '.index')) {
                array_push($data, $value);
            }
        });
    }

    return view('welcome', compact('data'));
});

Route::group(['auth:sanctum', 'verified'], function () {

    Route::get('users', [UserController::class, 'index'])
        ->middleware('can:users.index')->name('users.index');

    Route::get('profile/{user}', [UserController::class, 'show'])
        ->middleware('can:users.show')->name('users.show');

    Route::post('users/{user}/permission', [UserController::class, 'store'])
        ->middleware('can:users.permissions.edit')->name('users.permissions.edit');

    Route::get('roles', [RoleController::class, 'index'])
        ->middleware('can:roles.index')->name('roles.index');

    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])
        ->middleware('can:roles.edit')->name('roles.edit');

    Route::put('roles/{role}', [RoleController::class, 'update'])
        ->middleware('roles.update')->name('roles.update');

    Route::get('roles/create', [RoleController::class, 'create'])
        ->middleware('can:roles.create')->name('roles.create');

    Route::get('roles/{role}/delete', [RoleController::class, 'destroy'])
        ->middleware('can:roles.destroy')->name('roles.destroy');

    Route::get('permissions', [PermissionController::class, 'index'])
        ->middleware('can:permissions.index')->name('permissions.index');

    Route::post('permissions', [PermissionController::class, 'store'])
        ->middleware('permissions.store')->name('permissions.store');

    Route::get('permissions/{permission}/delete', [PermissionController::class, 'destroy'])
        ->middleware('can:permissions.destroy')->name('permissions.destroy');

    Route::get('posts', [PostController::class, 'index'])
        ->middleware('can:posts.index')->name('posts.index');

    Route::get('posts/{post}', [PostController::class, 'show'])
        ->middleware('can:posts.show')->name('posts.show');

    Route::get('post/comments', [CommentController::class, 'index'])->name('posts.comments.index');

    Route::get('comment/{comment}', [CommentController::class, 'show'])->name('comments.show');

    Route::get('test', [UserController::class, 'test'])->name('test');
});

