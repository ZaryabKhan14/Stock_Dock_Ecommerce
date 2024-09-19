<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\user\UserDashboardController;
use App\Http\Controllers\admin\AddUserDashboardController;
use App\Http\Controllers\admin\ShowUserController;
use App\Http\Controllers\admin\AddSliderController;
use App\Http\Controllers\admin\ShowSliderController;
use App\Http\Controllers\admin\AddProductController;
use App\Http\Controllers\user\ShowUserSliderController;
use App\Http\Controllers\user\ProductDetailsController;
use App\Http\Controllers\admin\ShowProductController;
use App\Http\Controllers\user\AddToCartController;
use App\Http\Controllers\user\CheckOutController;
use App\Http\Controllers\user\ShowOrderListController;
use App\Http\Controllers\admin\ShowOrdersController;
use App\Http\Controllers\user\ContactUsController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('user_Dashboard');
});

Route::get('/admin/add_user_form',[AddUserDashboardController::class,'user_form'])->name('user_form');
Route::post('/admin/add_user',[AddUserDashboardController::class,'add_user'])->name('add_user');
Route::get('/admin/show_user',[ShowUserController::class,'show_user'])->name('show_user');
Route::get('/admin/delete_user/{id}',[ShowUserController::class,'delete_user'])->name('delete_user');
Route::get('/admin/edit_user/{id}',[ShowUserController::class,'edit_user_form'])->name('edit_user_form');
Route::post('/admin/update_user/{id}',[ShowUserController::class,'update_user'])->name('update_user');
Route::get('/admin/add_slider_form',[AddSliderController::class,'add_slider_form'])->name('add_slider_form');
Route::post('/admin/add_slider',[AddSliderController::class,'add_slider'])->name('add_slider');
Route::get('/admin/show_slider',[ShowSliderController::class,'show_slider_page'])->name('show_slider_page');
Route::get('/admin/delete_slider/{id}',[ShowSliderController::class,'delete_slider'])->name('delete_slider');
Route::get('/admin/edit_slider_form/{id}',[ShowSliderController::class,'edit_slider_page'])->name('edit_slider_page');
Route::post('/admin/update_slider/{id}',[ShowSliderController::class,'update_slider'])->name('update_slider');
Route::get('/admin/add_product_form',[AddProductController::class,'add_product_form'])->name('add_product_form');
Route::post('/admin/add_product',[AddProductController::class,'add_product'])->name('add_product');
Route::get('/admin/show_product',[ShowProductController::class,'show_product_page'])->name('show_product_page');
Route::get('/admin/delete_product/{id}',[ShowProductController::class,'delete_product'])->name('delete_product');
Route::get('/admin/edit_product_form/{id}',[ShowProductController::class,'edit_product_form'])->name('edit_product_form');
Route::post('/admin/update_product/{id}',[ShowProductController::class,'update_product'])->name('update_product');
Route::get('/admin/orders/details/',[ShowOrdersController::class,'show_customer_orders'])->name('show_customer_orders');





Route::get('/user_dashboard',[UserDashboardController::class,'user_Dashboard'])->name('user_Dashboard');

Route::get('/user/slider',[ShowUserSliderController::class,'show_slider'])->name('show_slider');
Route::get('/product_details/{id}',[ProductDetailsController::class,'show_product_details'])->name('show_product_details');
Route::get('/user/all_product',[ProductDetailsController::class,'all_product'])->name('all_product');
Route::get('/user/add_to_cart_view',[AddToCartController::class,'add_to_cart_view'])->name('add_to_cart_view');
Route::post('/user/add_product_to_cart',[AddToCartController::class,'add_to_cart_product'])->name('add_to_cart_product');
Route::delete('/user/delete-cart-item', [AddToCartController::class, 'deleteItem'])->name('delete.cart.item');
Route::get('/user/checkout', [CheckOutController::class, 'show_checkout_form'])->name('show_checkout_form');
Route::post('/user/process_checkout', [CheckOutController::class, 'process_checkout'])->name('process_checkout');
Route::get('/order-success', function () {
    return view('user.order_success');
})->name('order.success');

Route::get('/user/orders', [ShowOrderListController::class, 'show_user_orders'])->name('show_user_orders');
Route::get('/user/contact_us/form', [ContactUsController::class, 'contact_us_form'])->name('contact_us_form');
Route::post('/user/contact_us', [ContactUsController::class, 'contact_us'])->name('contact_us');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/redirect',[DashboardController::class,'redirect'])->name('redirect');
Route::get('/admin_dashboard',[AdminDashboardController::class,'admin_dashboard'])->name('admin');

});
