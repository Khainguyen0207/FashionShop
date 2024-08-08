<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CategoriesController;

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

    Route::get('/forget-password', function () {
        return view('auth.forget-password', ['title' => 'Quên mật khẩu']);
    })->name('auth.forgetPassword'); 

});

Route::prefix('/admin')->middleware('CheckRoleAccess')->group(function () {
    // Home
    Route::get('/', [HomeController::class, 'index'])->name('admin.home');
    
    //customer
    Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customer.index');
    Route::delete('/customer/del/{id}', [CustomerController::class, 'destroy'])->name('admin.customer.del');
    
    //categories
    Route::get('/categories', [CategoriesController::class, 'home'])->name('categories.home');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{id_category}/del', [CategoriesController::class, 'destroy'])->name('categories.category.del');
    
    //categories - products
    Route::get('/categories/{id_category}', [ProductController::class, 'home'])->name('category.home');
    Route::get('/categories/{id_category}/products', [ProductController::class, 'index'])->name('category.products.home');
    Route::post('/categories/{id_category}/products', [ProductController::class, 'store'])->name('category.products.store');

    Route::get('/categories/{id_category}/products/edit/{product_id}', [ProductController::class, 'edit'])->name('category.products.edit');
    Route::post('/categories/{id_category}/products/edit/{product_id}', [ProductController::class, 'edit'])->name('category.products.edit');

    Route::delete('/categories/{id_category}/products/del/{product_id}', [ProductController::class, 'destroy'])->name('category.products.del');
    
    //categories - charts
    Route::get('/categories/{id_category}', [ProductController::class, 'home'])->name('category.home');
    Route::get('/categories/{id_category}/charts', [ProductController::class, 'index'])->name('category.charts.home');

    //categories - vouchers
    Route::get('/categories/{id_category}', [ProductController::class, 'home'])->name('category.home');
    Route::get('/categories/{id_category}/vouchers', [ProductController::class, 'index'])->name('category.vouchers.home');

    //Logout
    Route::get('/logout', [UserController::class, 'destroy'])->name('admin.logout');
});

Route::prefix('/user')->middleware('auth')->group(function () {

    Route::get('/', [UserController::class, 'home'])->name('user.home');
    Route::post('/', [UserController::class, 'store'])->name('user.home.post');

    //Logout
    Route::delete('/logout', [UserController::class, 'destroy'])->name('user.logout');

});