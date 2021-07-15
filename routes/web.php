<?php

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
Route::post('/response', [\App\Http\Controllers\PaymentController::class, 'response']);

Route::get('/success', [\App\Http\Controllers\PaymentController::class, 'success']);

Route::get('/pay', [\App\Http\Controllers\PaymentController::class, 'pay']);
Route::post('/pay', [\App\Http\Controllers\PaymentController::class, 'test']);

Route::get('/check/{id}', [\App\Http\Controllers\PaymentController::class, 'check'])->name('check');
Route::get('/index', [\App\Http\Controllers\PaymentController::class, 'indexOrders']);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('auth/{provider}', [\App\Http\Controllers\Auth\AuthController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [\App\Http\Controllers\Auth\AuthController::class, 'handleProviderCallback']);
Route::get('auth/setpassword', [\App\Http\Controllers\Auth\AuthController::class, 'setPassword']);
Route::post('auth/setpassword', [\App\Http\Controllers\Auth\AuthController::class, 'sendSetPassword']);
