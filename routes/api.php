<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\OrdersController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[\App\Http\Controllers\Api\V1\RegisterController::class, 'register']);

Route::get('/activation/{token}',[\App\Http\Controllers\Api\V1\RegisterController::class, 'activation']);

Route::post('/login',[\App\Http\Controllers\Api\V1\LoginController::class, 'login']);
// php artisan route:list
// authentication VS authorization
Route::middleware('auth:api', 'verified')->group(function (){
//    Route::apiResource('orders', OrdersController::class);
    Route::get('orders',[OrdersController::class, 'view']);
    Route::post('/',[OrdersController::class, 'create']);
//    Route::put('/{order}',[\App\Http\Controllers\Api\V1\OrdersController::class, 'update']);
});

//Route::get('/view', function () {
//    return \App\Http\Resources\OrderResource::collection(\App\Models\Order::paginate(3));
//});

Route::middleware('auth:passport')->post('/update', function (){
   return 'ok';
});

Route::get('/notify', function (){
    $user = \App\Models\User::first();
    $user->notify(new \App\Notifications\Order());
});
