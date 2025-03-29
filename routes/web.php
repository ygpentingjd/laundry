<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('customers', CustomerController::class);
Route::resource('services', ServiceController::class);
Route::resource('orders', OrderController::class);
