<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('my-home', 'App\Http\Controllers\HomeController@myHome');
Route::get('my-users', 'App\Http\Controllers\HomeController@myUsers');
Route::get('/products/cari','App\Http\Controllers\ProductController@cari');
Route::get('/products/cetak','App\Http\Controllers\ProductController2@index');
Route::get('/products/cetak/pdf','App\Http\Controllers\ProductController2@cetak_pdf');
Route::resource('products', \App\Http\Controllers\ProductController::class);


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
