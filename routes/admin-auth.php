<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('admin.register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])
        ->name('admin.login');

    Route::post('login', [LoginController::class, 'store']);

});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/index', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::get('/createposts', function () {
        return view('admin.createpost');
    })->name('admin.createposts');

    Route::get('/admin/createposts', action: [PostController::class, 'create'])->name('blog.create');


    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('admin.logout');
});
