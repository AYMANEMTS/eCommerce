<?php

use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Payment\StripePaymentController;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products',[StoreController::class,'index']);
Route::get('products/{id}',[StoreController::class,'show']);
Route::get('categories/items',[StoreController::class,'categoryItems']);
Route::get('lastProducts',[StoreController::class,'lastProducts']);
Route::post('createOrder',[StoreController::class,'storeOrder']);


Route::post('stripePost',[StripePaymentController::class,'stripePost']);


