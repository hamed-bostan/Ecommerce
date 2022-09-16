<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\RegisterController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\OrdersController;
use App\Http\Controllers\Api\V1\ProductController;
use \App\Http\Controllers\CartController;
use App\Models\User;
use App\Notifications\Order;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[RegisterController::class, 'register']);
Route::post('/login',[LoginController::class, 'login']);
Route::get('/activation/{token}',[RegisterController::class, 'activation']);

//Route::middleware('auth:api', 'verified')->group(function (){
    Route::get('/orders',[OrdersController::class, 'index']);
    Route::post('/orders',[OrdersController::class, 'store']);
    Route::put('/orders/{order}',[OrdersController::class, 'update']);
    Route::delete('/orders/{order}',[OrdersController::class,'destroy']);
    Route::get('/orders/ordering',[OrdersController::class,'ordering']);
//});

Route::middleware('auth:api', 'verified')->group(function (){
Route::get('/products/',[ProductController::class, 'index']);
Route::post('/products',[ProductController::class, 'store']);
Route::put('/products/{product}',[ProductController::class, 'update']);
Route::get('/products/{product}',[ProductController::class,'moredetails'])->name('more_details.product');
Route::delete('/products/{product}',[ProductController::class,'destroy']);
});

Route::get('/notify', function (){
    $user = User::first();
//    $user = User::first();
    $user->notify(new Order());
});

//Route::middleware('auth:api', 'verified')->group(function (){
    Route::get('/carts/',[CartController::class, 'index'])->name('cart.index');
    Route::post('/carts',[CartController::class, 'store'])->name('cart.store');
//});


