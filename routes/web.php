<?php

use App\Http\Controllers\Cabinet\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');



Route::controller(\App\Http\Controllers\LoginController::class)->group(function() {
    Route::get('login', 'index')->name('login.form');
    Route::post('login', 'login')->name('login');
    Route::post('logout', 'logout')->name('logout');
});

Route::controller(\App\Http\Controllers\RegisterController::class)->group(function() {
    Route::get('register', 'index')->name('register.form');
    Route::post('register', 'register')->name('register');
});


Route::controller(\App\Http\Controllers\AuthController::class)->group(function() {
//    Route::get('login', 'index')->name('login');
//    Route::post('login', 'signIn')->name('login.signin');

//    Route::get('sign-up', 'signUp')->name('register');
//    Route::post('sign-up', 'store')->name('register.store');
//    Route::delete('logout', 'logOut')->name('logOut');

//    Route::get('/forgot-password', 'forgot')->middleware('guest')->name('password.request');
//    Route::post('/forgot-password', 'forgotPassword')->middleware('guest')->name('password.email');
//    Route::get('/reset-password/{token}', 'reset')->middleware('guest')->name('password.reset');
//    Route::post('/reset-password', 'resetPassword')->middleware('guest')->name('password.update');

});



Route::prefix('cabinet')->middleware(['only-auth'])->group(function (){
    Route::get('/', [DashboardController::class, 'index'])->name('cabinet.dashboard');
});
