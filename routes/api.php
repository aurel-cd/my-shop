<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login',[AuthController::class, 'loginUser']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('users', [UsersController::class, 'showUsers']);
    Route::get('user/{user}', [UsersController::class, 'showUser']);

    Route::get('/products', [ProductsController::class, 'showProducts']);
    Route::get('/product/{product}', [ProductsController::class, 'showProduct']);

    Route::get('/orders', [OrderController::class, 'showOrders']);
    Route::get('/order/{order}', [OrderController::class, 'showOrder']);
});







