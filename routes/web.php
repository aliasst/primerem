<?php

use App\Http\Controllers\Cabinet\DashboardController;
use App\Http\Controllers\Cabinet\InvoiceController;
use App\Http\Controllers\Cabinet\ProjectController;
use App\Http\Controllers\Cabinet\ProjectUserController;
use App\Http\Controllers\Cabinet\SuperUserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');



Route::controller(\App\Http\Controllers\LoginController::class)->group(function() {
    Route::get('login', 'index')->middleware(['only-guest'])->name('login.form');
    Route::post('login', 'login')->middleware(['only-guest'])->name('login');
    Route::post('logout', 'logout')->name('logout');
});

Route::controller(\App\Http\Controllers\RegisterController::class)->middleware(['only-guest'])->group(function() {
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

    Route::get('/projects', [ProjectController::class, 'index'])->name('cabinet.project.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('cabinet.project.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('cabinet.project.store');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('cabinet.project.show');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('cabinet.project.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('cabinet.project.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('cabinet.project.destroy');

    Route::get('/projects/{project}/users', [ProjectUserController::class, 'index'])->name('cabinet.project.user.index');
    Route::get('/projects/{project}/users/create', [ProjectUserController::class, 'create'])->name('cabinet.project.user.create');
    Route::post('/projects/{project}/users', [ProjectUserController::class, 'store'])->name('cabinet.project.user.store');

    Route::get('/projects/{project}/users/{user}/edit', [ProjectUserController::class, 'edit'])->name('cabinet.project.user.edit');
    Route::put('/projects/{project}/users/{user}', [ProjectUserController::class, 'update'])->name('cabinet.project.user.update');
    Route::delete('/projects/{project}/users/{user}', [ProjectUserController::class, 'destroy'])->name('cabinet.project.user.destroy');


    Route::get('/superusers', [SuperUserController::class, 'index'])->name('cabinet.superuser.index');
    Route::get('/superusers/create', [SuperUserController::class, 'create'])->name('cabinet.superuser.create');
    Route::post('/superusers', [SuperUserController::class, 'store'])->name('cabinet.superuser.store');
    Route::get('/superusers/{user}/edit', [SuperUserController::class, 'edit'])->name('cabinet.superuser.edit');
    Route::put('/superusers/{user}', [SuperUserController::class, 'update'])->name('cabinet.superuser.update');
    Route::delete('/superusers/{user}', [SuperUserController::class, 'destroy'])->name('cabinet.superuser.destroy');


    Route::get('/invoices', [InvoiceController::class, 'index'])->name('cabinet.invoice.index');
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('cabinet.invoice.create');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('cabinet.invoice.store');
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('cabinet.invoice.show');
    Route::get('/invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('cabinet.invoice.edit');
    Route::put('/invoices/{invoice}', [InvoiceController::class, 'update'])->name('cabinet.invoice.update');
    Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('cabinet.invoice.destroy');
});
