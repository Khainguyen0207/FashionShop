<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\admin\EventController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\User\RankUIController;
use App\Http\Controllers\Admin\SettupController;
use App\Http\Controllers\User\OrderUIController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\User\ProductUIController;
use App\Http\Controllers\User\VoucherUIController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\User\EventBlogController;

Route::get('/getData', [PayController::class, 'return'])->name('getDataBanking');

Route::view('/welcome', 'welcome')->name('welcome');

Route::get('/', [UserController::class, 'home'])->name('user.home');
Route::post('/', [UserController::class, 'store'])->name('user.home.post');

//Event_Blog
Route::get('/events', [EventBlogController::class, 'index'])->name('user.event.home');
Route::get('/events/title={title_blog}&id={id}', [EventBlogController::class, 'show'])->name('user.event.show');
    
//Cart
Route::get('/cart', [CartController::class, 'index'])->name('user.cart.home');
Route::post('/cart/{product_id}', [CartController::class, 'store'])->name('user.cart.post');
Route::delete('/cart/{product_id}/del', [CartController::class, 'destroy'])->name('user.cart.del');

//Products
Route::get('/products', [ProductUIController::class, 'index'])->name('products.home');
Route::post('/products', [ProductUIController::class, 'store'])->name('products.home.post');
Route::post('/products/arrange', [ProductUIController::class, 'arrange'])->name('products.home.arrange');
Route::get('/products/{category_id}', [ProductUIController::class, 'show_products'])->name('products.id');
Route::get('/products/{category_id}/product', [ProductUIController::class, 'show_products']);

//Product
Route::get('/products/{category_id}/product/{product_id}', [ProductUIController::class, 'show'])->name('product.id');
Route::get('/information_product', [ProductUIController::class, 'getSizeAndColor'])->name('product.getSizeAndColor');

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
    //Upload 
    Route::post('/upload', [HomeController::class, 'upload'])->name('upload.home');
    //customer
    Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customer.index');
    Route::post('/customer', [CustomerController::class, 'show'])->name('admin.customer.show');
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
    Route::post('/categories/{id_category}/products/edit/{product_id}', [ProductController::class, 'update'])->name('category.products.update');
    Route::delete('/categories/{id_category}/products/del/{product_id}', [ProductController::class, 'destroy'])->name('category.products.del');

    //categories - excel
    Route::post('/categories/{id_category}/products/import', [ExcelController::class, 'import'])->name('category.products.import');
    Route::get('/categories/{id_category}/products/export', [ExcelController::class, 'export'])->name('category.products.export');
    
    //categories - charts
    Route::get('/categories/{id_category}', [ProductController::class, 'home'])->name('category.home');
    Route::get('/categories/{id_category}/charts', [ProductController::class, 'index'])->name('category.charts.home');

    //categories - vouchers
    Route::get('/categories/{id_category}', [ProductController::class, 'home'])->name('category.home');
    Route::get('/categories/{id_category}/vouchers', [ProductController::class, 'index'])->name('category.vouchers.home');

    //Order
    Route::prefix('/order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('order.home');
        //confirmation-order
        Route::get('/confirmation-order', [OrderController::class, 'pending_confirmation_orders'])->name('order.pending');
        Route::post('/confirmation-order', [OrderController::class, 'store'])->name('order.pending');
        Route::post('/confirmation-order/edit/{order_id}', [OrderController::class, 'edit'])->name('order.pending.edit');
        Route::post('/confirmation-order/info/{order_id}', [OrderController::class, 'show'])->name('order.pending.show');
        Route::delete('/confirmation-order/del/{order_id}', [OrderController::class, 'destroy'])->name('order.pending.destroy');
        //order_in_transit
        Route::get('/order_in_transit', [OrderController::class, 'order_in_transit'])->name('order.order_in_transit');
        Route::post('/order_in_transit/edit/{order_id}', [OrderController::class, 'edit'])->name('order.order_in_transit.edit');
        Route::post('/order_in_transit/info/{order_id}', [OrderController::class, 'show'])->name('order.order_in_transit.show');
        Route::delete('/order_in_transit/del/{order_id}', [OrderController::class, 'destroy'])->name('order.order_in_transit.del');

        //orders
        Route::get('/orders', [OrderController::class, 'orders'])->name('order.orders');
        Route::post('/orders/edit/{order_id}', function () {});
        Route::post('/orders/info/{order_id}', [OrderController::class, 'show'])->name('order.orders.show');
        Route::delete('/orders/del/{order_id}', function ($id) {
            return redirect()->back()->with('error', 'Không thể xóa đơn hàng');
        });
    });

    //Setting
    Route::get('/setting', [SettupController::class, 'home'])->name('admin.setting.home');
    Route::get('/upload_settup_sample', [SettupController::class, 'get_data_settup'])->name('admin.setting.upload_settup_sample');
    Route::post('/setting/edit', [SettupController::class, 'edit'])->name('admin.setting.edit');
    Route::patch('/setting/edit_admin', [SettupController::class, 'update'])->name('admin.setting.edit_admin');
    Route::delete('/setting/del/id={id}', [SettupController::class, 'destroy'])->name('admin.setting.destroy');
    
    //Event
    Route::get('/event', [EventController::class, 'home'])->name('admin.event.home');
    Route::post('/event', [EventController::class, 'store'])->name('admin.event.store');

    Route::get('/event/edit/{id}', [EventController::class, 'edit'])->name('admin.event.edit');
    Route::patch('/event/edit/{id}', [EventController::class, 'update'])->name('admin.event.show');

    Route::delete('/event/del/{id}', [EventController::class, 'destroy'])->name('admin.event.destroy');
    //Logout
    Route::get('/logout', [UserController::class, 'destroy'])->name('admin.logout');
});

Route::prefix('/user')->middleware('CheckAuth')->group(function () {
    //Profile
    Route::prefix('/profile')->group(function () {
        //Profile
        Route::get('/', [ProfileController::class, 'index'])->name('profile.home');
        Route::post('/', [ProfileController::class, 'store'])->name('profile.post');
        Route::post('/show', [ProfileController::class, 'show'])->name('profile.show');
        Route::post('/sendmail', [ProfileController::class, 'edit'])->name('profile.sendmail');

        Route::get('/confirm/{token}', [ProfileController::class, 'reset_password'])->name('profile.reset_password');
        Route::post('/confirm', [ProfileController::class, 'confirm'])->name('profile.confirm');
        Route::post('/change', [ProfileController::class, 'change_password'])->name('profile.change');
        //Order
        Route::get('/order', [OrderUIController::class, 'index'])->name('profile.order.home');
        Route::post('/order', [OrderUIController::class, 'show'])->name('profile.order.show');
        Route::delete('/order', [OrderUIController::class, 'destroy'])->name('profile.order.destroy');
        //Voucher
        Route::get('/voucher', [VoucherUIController::class, 'index'])->name('profile.voucher.home');
        Route::post('/voucher', [VoucherUIController::class, 'store'])->name('profile.voucher.post');
        //Rank
        Route::get('/rank', [RankUIController::class, 'index'])->name('profile.rank.home');
        Route::post('/rank', [RankUIController::class, 'store'])->name('profile.rank.post');
    });

    //Pay
    Route::get('/pay', [PayController::class, 'index'])->name('user.pay.home');
    Route::post('/pay', [PayController::class, 'store'])->name('user.pay.post');
    Route::post('/pay/success', [PayController::class, 'order'])->name('user.pay.order');

    //Logout
    Route::delete('/logout', [UserController::class, 'destroy'])->name('user.logout');
});
