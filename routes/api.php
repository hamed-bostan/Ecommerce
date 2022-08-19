<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[\App\Http\Controllers\RegisterController::class,'register']);

Route::get('/activation/{token}',[\App\Http\Controllers\RegisterController::class,'activation']);

Route::post('/login',[\App\Http\Controllers\LoginController::class,'login']);



Route::get('/index',[\App\Http\Controllers\OrdersController::class,'index']);

Route::post('/store',[\App\Http\Controllers\OrdersController::class,'store']);

Route::post('/order/{order}',[\App\Http\Controllers\OrdersController::class,'update']);




