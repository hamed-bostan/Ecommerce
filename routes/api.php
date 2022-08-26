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

Route::post('/register',[\App\Http\Controllers\Api\V1\RegisterController::class, 'register']);

Route::get('/activation/{token}',[\App\Http\Controllers\Api\V1\RegisterController::class, 'activation']);

Route::post('/login',[\App\Http\Controllers\Api\V1\LoginController::class, 'login']);

//Route::group(['prefix'=>'/orders'],function (){
//    Route::get('/',[\App\Http\Controllers\Api\V1\OrdersController::class, 'index']);
//    Route::post('',[\App\Http\Controllers\Api\V1\OrdersController::class, 'store']);
//    Route::put('/{order}',[\App\Http\Controllers\Api\V1\OrdersController::class, 'update']);
//});


Route::group(['prefix'=>'/orders'],function (){
    Route::get('/',[\App\Policies\OrderPolicy::class,'view']);
    Route::post('',[\App\Policies\OrderPolicy::class, 'create']);
    Route::put('/{order}',[\App\Policies\OrderPolicy::class, 'update']);
});
