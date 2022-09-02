<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\RegisterController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\OrdersController;
use App\Http\Controllers\Api\V1\ProductController;
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
//});

//Route::get('/view', function () {
//    return \App\Http\Resources\OrderResource::collection(\App\Models\Order::paginate(3));
//});


//Route::middleware('auth:api', 'verified')->group(function (){
Route::get('/products',[ProductController::class, 'index']);
Route::post('/products',[ProductController::class, 'store']);
Route::put('/products/{product}',[ProductController::class, 'update']);
//});


Route::get('/notify', function (){
    $user = User::first();
    $user->notify(new Order());
});
