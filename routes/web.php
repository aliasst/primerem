<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Cabinet\DashboardController;
use App\Http\Controllers\Cabinet\ProfileController;
use App\Http\Controllers\Cabinet\ProjectActController;
use App\Http\Controllers\Cabinet\ProjectContractorController;
use App\Http\Controllers\Cabinet\ProjectFileController;
use App\Http\Controllers\Cabinet\ProjectInvoiceController;
use App\Http\Controllers\Cabinet\ProjectController;
use App\Http\Controllers\Cabinet\ProjectPurchaseController;
use App\Http\Controllers\Cabinet\ProjectReportController;
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

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request')->middleware('only-guest');


Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');


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
    Route::get('/profile', [ProfileController::class, 'index'])->name('cabinet.profile');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('cabinet.profile.update');

    Route::get('/', [DashboardController::class, 'index'])->name('cabinet.dashboard');

    Route::get('/projects', [ProjectController::class, 'index'])->name('cabinet.project.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('cabinet.project.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('cabinet.project.store');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('cabinet.project.show');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('cabinet.project.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('cabinet.project.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('cabinet.project.destroy');
    Route::get('/projects/{project}/copy', [ProjectController::class, 'copy'])->name('cabinet.project.copy');
    Route::get('/projects/{project}/copystages', [ProjectController::class, 'copyStages'])->name('cabinet.project.copystages');



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

    Route::get('/projects/{project}/reports', [ProjectReportController::class, 'index'])->name('cabinet.project.report.index');
    Route::post('/projects/{project}/reports', [ProjectReportController::class, 'store'])->name('cabinet.project.report.store');
    Route::get('/projects/{project}/reports/{stage}', [ProjectReportController::class, 'show'])->name('cabinet.project.report.show');
    Route::get('/projects/{project}/reports/{stage}/edit', [ProjectReportController::class, 'edit'])->name('cabinet.project.report.edit');
    Route::put('/projects/{project}/reports/{stage}', [ProjectReportController::class, 'update'])->name('cabinet.project.report.update');


    Route::get('/projects/{project}/contractors', [ProjectContractorController::class, 'index'])->name('cabinet.project.contractor.index');
    Route::get('/projects/{project}/contractors/create', [ProjectContractorController::class, 'create'])->name('cabinet.project.contractor.create');
    Route::post('/projects/{project}/contractors', [ProjectContractorController::class, 'store'])->name('cabinet.project.contractor.store');
    Route::get('/projects/{project}/contractors/{contractor}', [ProjectContractorController::class, 'show'])->name('cabinet.project.contractor.show');
    Route::get('/projects/{project}/contractors/{contractor}/edit', [ProjectContractorController::class, 'edit'])->name('cabinet.project.contractor.edit');
    Route::put('/projects/{project}/contractors/{contractor}', [ProjectContractorController::class, 'update'])->name('cabinet.project.contractor.update');
    Route::delete('/projects/{project}/contractors/{contractor}', [ProjectContractorController::class, 'destroy'])->name('cabinet.project.contractor.destroy');


    Route::get('/projects/{project}/purchases', [ProjectPurchaseController::class, 'index'])->name('cabinet.project.purchase.index');
    Route::get('/projects/{project}/purchases/create', [ProjectPurchaseController::class, 'create'])->name('cabinet.project.purchase.create');
    Route::post('/projects/{project}/purchases', [ProjectPurchaseController::class, 'store'])->name('cabinet.project.purchase.store');
    Route::get('/projects/{project}/purchases/{purchase}', [ProjectPurchaseController::class, 'show'])->name('cabinet.project.purchase.show');
    Route::get('/projects/{project}/purchases/{purchase}/edit', [ProjectPurchaseController::class, 'edit'])->name('cabinet.project.purchase.edit');
    Route::put('/projects/{project}/purchases/{purchase}', [ProjectPurchaseController::class, 'update'])->name('cabinet.project.purchase.update');
    Route::delete('/projects/{project}/purchases/{purchase}', [ProjectPurchaseController::class, 'destroy'])->name('cabinet.project.purchase.destroy');


    Route::get('/delete-stage-file/{id}', [ProjectFileController::class, 'deleteStageFile']);
    Route::get('/delete-purchase-file/{id}', [ProjectFileController::class, 'deletePurchaseFile']);

});
