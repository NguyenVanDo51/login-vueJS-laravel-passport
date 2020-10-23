<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PermissionControllerApi;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController::class, 'login']);

Route::post('register', [RegisterController::class, 'register']);

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('logout', [LogoutController::class, 'logout']);
    Route::get('test', [LoginController::class, 'test']);

    Route::get('posts', [PostController::class, 'index'])
        ->middleware('can:posts.index')->name('posts.index');

    Route::get('posts/{post}', [PostController::class, 'show'])
        ->middleware('can:posts.show')->name('posts.show');

    Route::get('post/comments', [CommentController::class, 'index']);

    Route::get('comment/{comment}', [CommentController::class, 'show']);

    Route::get('test', [UserController::class, 'test'])->name('test');

    Route::get('permission', [PermissionControllerApi::class, 'show']);
});

Route::post('reset-password', [ResetPasswordController::class, 'sendMail']);

Route::get('hehe',function() {
    return response()->json([
        'message' => 'HEHE'
    ]);
});

Route::put('confirm-reset-password', [ResetPasswordController::class, 'reset']);
