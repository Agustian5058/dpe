<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('/sales', \App\Http\Controllers\SalesController::class);
Route::resource('/login', \App\Http\Controllers\LoginController::class);
Route::resource('/logout', \App\Http\Controllers\LogoutController::class);
Route::resource('/dashboard', \App\Http\Controllers\DashboardController::class);
Route::resource('/user', \App\Http\Controllers\UserController::class);
Route::resource('/profile', \App\Http\Controllers\ProfileController::class);
Route::resource('/vehicle', \App\Http\Controllers\VehicleController::class);
Route::resource('/sales', \App\Http\Controllers\SalesController::class);
Route::resource('/customer', \App\Http\Controllers\CustomerController::class);
Route::resource('/arrival', \App\Http\Controllers\VehicleArrivalController::class);
Route::resource('/transaction_type', \App\Http\Controllers\TransactionTypeController::class);
Route::resource('/transaction', \App\Http\Controllers\TransactionController::class);