<?php

use App\Http\Controllers\Cabinet\DashboardController;
use App\Http\Controllers\Cabinet\ProjectActController;
use App\Http\Controllers\Cabinet\ProjectInvoiceController;
use App\Http\Controllers\Cabinet\ProjectController;
use App\Http\Controllers\Cabinet\ProjectStageController;
use App\Http\Controllers\Cabinet\ProjectUserController;
use App\Http\Controllers\Cabinet\SuperUserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/test', [\App\Http\Controllers\Cabinet\ProjectStageController::class, 'test']);



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


    Route::get('/projects/{project}/invoices', [ProjectInvoiceController::class, 'index'])->name('cabinet.project.invoice.index');
    Route::get('/projects/{project}/invoices/create', [ProjectInvoiceController::class, 'create'])->name('cabinet.project.invoice.create');
    Route::post('/projects/{project}/invoices', [ProjectInvoiceController::class, 'store'])->name('cabinet.project.invoice.store');
    Route::get('/projects/{project}/invoices/{invoice}', [ProjectInvoiceController::class, 'show'])->name('cabinet.project.invoice.show');
    Route::get('/projects/{project}/invoices/{invoice}/edit', [ProjectInvoiceController::class, 'edit'])->name('cabinet.project.invoice.edit');
    Route::put('/projects/{project}/invoices/{invoice}', [ProjectInvoiceController::class, 'update'])->name('cabinet.project.invoice.update');
    Route::delete('/projects/{project}/invoices/{invoice}', [ProjectInvoiceController::class, 'destroy'])->name('cabinet.project.invoice.destroy');

    Route::get('/projects/{project}/acts', [ProjectActController::class, 'index'])->name('cabinet.project.act.index');
    Route::get('/projects/{project}/acts/create', [ProjectActController::class, 'create'])->name('cabinet.project.act.create');
    Route::post('/projects/{project}/acts', [ProjectActController::class, 'store'])->name('cabinet.project.act.store');
    Route::get('/projects/{project}/acts/{act}', [ProjectActController::class, 'show'])->name('cabinet.project.act.show');
    Route::get('/projects/{project}/acts/{act}/edit', [ProjectActController::class, 'edit'])->name('cabinet.project.act.edit');
    Route::put('/projects/{project}/acts/{act}', [ProjectActController::class, 'update'])->name('cabinet.project.act.update');
    Route::delete('/projects/{project}/acts/{act}', [ProjectActController::class, 'destroy'])->name('cabinet.project.act.destroy');

    Route::get('/projects/{project}/stages', [ProjectStageController::class, 'index'])->name('cabinet.project.stage.index');
    Route::get('/projects/{project}/stages/create', [ProjectStageController::class, 'create'])->name('cabinet.project.stage.create');
    Route::post('/projects/{project}/stages', [ProjectStageController::class, 'store'])->name('cabinet.project.stage.store');
    Route::get('/projects/{project}/stages/{stage}', [ProjectStageController::class, 'show'])->name('cabinet.project.stage.show');
    Route::get('/projects/{project}/stages/{stage}/edit', [ProjectStageController::class, 'edit'])->name('cabinet.project.stage.edit');
    Route::put('/projects/{project}/stages/{stage}', [ProjectStageController::class, 'update'])->name('cabinet.project.stage.update');
    Route::delete('/projects/{project}/stages/{stage}', [ProjectStageController::class, 'destroy'])->name('cabinet.project.stage.destroy');


});
