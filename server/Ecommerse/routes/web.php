<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageProductController;
use App\Http\Controllers\Payment\PaypalPaymentController;
use App\Http\Controllers\Payment\StripePaymentController;
use App\Http\Controllers\PaymentSuccessController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSectionController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
})->name('publicHome');

route::middleware(['auth.admin'])->group(function () {
    route::resource('admin/products',ProductController::class);
    route::resource('admin/category',CategoryController::class);
});
Route::get('delete/image/{imageId}/{productId}',[ImageProductController::class,'deleteImage'])->name('deleteImage')->middleware('auth');
Auth::routes();

route::middleware(['auth.editor'])->group(function () {
    //product
    Route::get('editor/dashboard',[EditorController::class,'dashbord'])->name('editor.dashbord');
    Route::resource('editor/products-e',ProductController::class);
    //category
    Route::resource('editor/categories',CategoryController::class);

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* text editor */
Route::middleware(['auth'])->group(function (){
   Route::get('product/{id}/sections',[ProductSectionController::class,'index'])->name('section.index');
   Route::get('product/sections/{id}',[ProductSectionController::class,'show'])->name('section.show');
   Route::get('product/{id}/add_section',[ProductSectionController::class,'create'])->name('section.create');
   Route::post('product/{id}/store_section',[ProductSectionController::class,'store'])->name('section.store');
   Route::get('product/{id}/edit_section',[ProductSectionController::class,'edit'])->name('section.edit');
   Route::post('product/{id}/update_section',[ProductSectionController::class,'update'])->name('section.update');
   Route::post('product/{id}/delete_section',[ProductSectionController::class,'destroy'])->name('section.destroy');
});
/* orders */
Route::middleware(['auth'])->group(function (){
    Route::get('orders',[OrderProductController::class,'index'])->name('orders.index');
    Route::post('order/{id}',[OrderProductController::class,'changeStatus'])->name('orders.changeStatus');
    Route::post('order/delete/{id}',[OrderProductController::class,'destroy'])->name('orders.destroy');
});



route::resource("users",UserController::class)->middleware('auth');
route::resource("payments", PaymentSuccessController::class)->middleware('auth');
route::get("permissions/create/{id}",[ PermissionController::class,'create'])->middleware('auth')->name('permissions.create');
route::post("permissions/create/{id}",[ PermissionController::class,'store'])->middleware('auth')->name("permissions.store");

Route::get('dashboard',[HomeController::class,'dashboard'])->name('admin.home')->middleware('auth');


//Route::get('stripe',[StripePaymentController::class,'stripe'])->name('stripe');
//Route::post('stripe',[StripePaymentController::class,'stripePost'])->name('stripe.post');

