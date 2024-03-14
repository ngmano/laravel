<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProductController,
    PaymentController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'index']);
Route::get('/product/view/{id}', [ProductController::class, 'view']);

Route::get('/payment', [PaymentController::class, 'index']);
Route::post('/checkout', [PaymentController::class, 'checkout']);