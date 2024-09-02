<?php

use Illuminate\Http\Request;
use App\Mail\UserActivationEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\User\ProductUIController;
use App\Http\Controllers\User\ProductsUIController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Auth\ForgetPasswordController;

Route::get('/', [LoginController::class, 'index'])->name('home');
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('hi',function() {
    $token = Hash::make("tkhai12386@gmail.com");
    Mail::to("cudaimst1@gmail.com") ->send(new UserActivationEmail("Mã khôi phục - Fashion Store", floor(rand(1000, 9999))));
    return redirect(route('auth.forgetPassword'))->with('success', 'Mã xác thực được gửi vào mail của bạn');
});

Route::prefix('/auth')->middleware('guest')->group(function () {

    Route::get('/', [LoginController::class, 'showFormLogin'])->name('login');
    //login
    Route::get('/login', [LoginController::class, 'showFormLogin'])->name('auth.login');
    Route::post('/login', [LoginController::class, 'store'])->name('auth.login.post');

    //Register
    Route::get('/register', [RegisterController::class, 'home'])->name('auth.register');
    Route::post('/register', [RegisterController::class, 'store'])->name('auth.register.post');

    //Forget password 
    Route::get('/forget-password', [ForgetPasswordController::class, 'index'])->name('auth.forgetPassword.home'); 
    Route::post('/forget-password', [ForgetPasswordController::class, 'store'])->name('auth.forgetPassword.store');
    
    Route::get('/forget-password/confirm', [ForgetPasswordController::class, 'edit'])->name('password.reset');
    Route::post('/forget-password/confirm', [ForgetPasswordController::class, 'confirm'])->name('password.reset.confirm');

    Route::get('/forget-password/change', [ForgetPasswordController::class, 'edit_password'])->name('password.change');
    Route::post('/forget-password/change', [ForgetPasswordController::class, 'change'])->name('password.change.confirm');
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
    //categories - excel
    Route::post('/categories/{id_category}/products/import', [ExcelController::class, 'import'])->name('category.products.import');
    Route::get('/categories/{id_category}/products/export', [ExcelController::class, 'export'])->name('category.products.export');

    Route::get('/categories/{id_category}/products/edit/{product_id}', [ProductController::class, 'edit'])->name('category.products.edit');
    Route::post('/categories/{id_category}/products/edit/{product_id}', [ProductController::class, 'update'])->name('category.products.update');

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
    //Home
    Route::get('/', [UserController::class, 'home'])->name('user.home');
    Route::post('/', [UserController::class, 'store'])->name('user.home.post');

    //Products
    Route::get('/products',[ProductUIController::class, 'index'])->name('products.home');
    Route::post('/products',[ProductUIController::class, 'store'])->name('products.home.post');
    Route::get('/products/{category_id}',[ProductUIController::class, 'show_products'])->name('products.id');
    Route::get('/products/{category_id}/product',[ProductUIController::class, 'show_products']);
    
    //Product
    Route::get('/products/{category_id}/product/{product_id}', [ProductUIController::class, 'show'])->name('product.id');
    Route::get('/render', [ProductUIController::class, 'render']);

    //Cart
    Route::get('/cart', [CartController::class, 'index'])->name('user.cart.home');

    //Pay
    Route::get('/pay', [PayController::class, 'index'])->name('user.pay.home');
    
    //Logout
    Route::delete('/logout', [UserController::class, 'destroy'])->name('user.logout');
});