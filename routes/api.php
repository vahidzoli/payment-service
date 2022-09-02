<?php

use App\Http\Controllers\API\OrderController;
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

Route::get('orders', [OrderController::class, 'index']);
Route::get('orders/{order}', [OrderController::class, 'show']);
Route::post('orders', [OrderController::class, 'store']);
Route::put('orders/{order}', [OrderController::class, 'update']);
Route::delete('orders/{order}', [OrderController::class, 'destroy']);

Route::post('orders/{order}/add', [OrderController::class, 'addProductToOrder']);
Route::post('orders/{order}/pay', [OrderController::class, 'payOrder']);
