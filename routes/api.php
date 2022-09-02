<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\OrdersController;
use App\Http\Controllers\Api\V1\ProductController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[\App\Http\Controllers\Api\V1\RegisterController::class, 'register']);
Route::post('/login',[\App\Http\Controllers\Api\V1\LoginController::class, 'login']);
Route::get('/activation/{token}',[\App\Http\Controllers\Api\V1\RegisterController::class, 'activation']);


//Route::middleware('auth:api', 'verified')->group(function (){
    Route::get('/orders',[OrdersController::class, 'index']);
    Route::post('/orders',[OrdersController::class, 'store']);
    Route::put('/orders/{order}',[\App\Http\Controllers\Api\V1\OrdersController::class, 'update']);
//});

//Route::get('/view', function () {
//    return \App\Http\Resources\OrderResource::collection(\App\Models\Order::paginate(3));
//});


//Route::middleware('auth:api', 'verified')->group(function (){
Route::get('/products',[ProductController::class, 'index']);
Route::post('/products',[ProductController::class, 'store']);
Route::put('/products/{product}',[\App\Http\Controllers\Api\V1\OrdersController::class, 'update']);
//});


Route::get('/notify', function (){
    $user = \App\Models\User::first();
    $user->notify(new \App\Notifications\Order());
});
