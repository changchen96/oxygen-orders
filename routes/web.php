<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function() {
    Route::controller(OrderController::class)->group(function() {
        Route::get('/orders', 'index');
        Route::post('/orders', 'update');
        Route::put('/orders', 'add');
    });

    Route::controller(OrderDetailsItemController::class)->group(function() {
        Route::get('/order_details', 'index');
    });
});