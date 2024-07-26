<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function() {
    if (Auth::check()) {
        return redirect(route('user.home'));
    } else {
        return redirect(route('login'));
    }
});

Route::prefix('/auth')->middleware('guest')->group(function () {

    Route::get('/', [LoginController::class, 'showFormLogin'])->name('login');

    Route::get('/login', [LoginController::class, 'showFormLogin'])->name('auth.login');

    Route::post('/login', [LoginController::class, 'store'])->name('auth.login.post');
    
    Route::get('/register', [RegisterController::class, 'home'])->name('auth.register');

    Route::post('/register', [RegisterController::class, 'store'])->name('auth.register.post');

    Route::get('/forgetPassword', function () {
        return view('auth.forgetPassword', ['title' => 'Quên mật khẩu']);
    })->name('auth.forgetPassword'); 

});

Route::prefix('/admin')->middleware('CheckRoleAccess')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('admin.home');

    Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customer.index');
    Route::get('/customer/page-{page}', [CustomerController::class, 'page'])->name('admin.customer.page');
    Route::delete('/customer/del-{id}', [CustomerController::class, 'destroy'])->name('admin.customer.del');

    Route::get('/logout', [UserController::class, 'destroy'])->name('admin.logout');
});

Route::prefix('/user')->middleware('auth')->group(function () {

    Route::get('/', [UserController::class, 'home'])->name('user.home');

    Route::post('/', [UserController::class, 'store'])->name('user.home.post');

    Route::delete('/logout', [UserController::class, 'destroy'])->name('user.logout');

});

