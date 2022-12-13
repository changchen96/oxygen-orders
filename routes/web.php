<?php

use App\Http\Controllers\OrderDetailsController;
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
    Route::controller(OrderDetailsController::class)->group(function() {
        Route::get('/orders', 'index');
        Route::post('/orders', 'update');
        Route::put('/orders', 'add');
    });
});