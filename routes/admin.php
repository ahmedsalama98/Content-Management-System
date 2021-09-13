<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\RegisterController;
use App\Http\Controllers\Backend\Auth\VerificationController;
use App\Http\Controllers\Backend\Auth\ResetPasswordController;
use App\Http\Controllers\Backend\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\IndexPage\AdminIndexPageController;






Route::prefix('admin')->name('admin.')->group(function(){
    // Authentication Routes..


    Route::get('/login',                            [ LoginController::class,'showLoginForm'])->name('login');
    Route::post('/login',                            [ LoginController::class,'login'])->name('login.store');
    Route::post('/logout',                           [ LoginController::class,'logout'])->name('logout');
    // Route::get('/register',                          [ RegisterController::class,'showRegistrationForm'])->name('show_register_form');
    // Route::post('/register',                         [ RegisterController::class,'register'])->name('register');
    // Route::get('/password/reset',                    [ ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
    // Route::post('/password/email',                   [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
    // Route::get('/password/reset/{token}',            [ ResetPasswordController::class,'showResetForm'])->name('password.reset');
    // Route::post('/password/reset',                   [ ResetPasswordController::class,'reset'])->name('password.update');
    // Route::get('/email/verify',                      [VerificationController::class,'show'])->name('verification.notice');
    // Route::get('/email/verify/{id}/{hash}',         [ VerificationController::class,'verify'])->name('verification.verify');
    // Route::post('/email/resend',                     [ VerificationController::class,'resend'])->name('verification.resend');

    // Authentication Routes..






    Route::middleware('role:super-admin|admin')->group(function(){
       //admin dashboard


        Route::get('/dashboard',[AdminIndexPageController::class , 'index'] )->name('dashboard');

    });




});

Route::get('/admin',function(){

    return  redirect()->route('admin.dashboard');

 } );

