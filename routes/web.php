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

Route::controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('productList');
    Route::get('/product/view/{product}', 'view')->name('productView');
});
Route::controller(PaymentController::class)->group(function () {
    Route::get('/payment', 'index')->name('paymentResult');
    Route::post('/checkout', 'checkout')->name('checkout');
});