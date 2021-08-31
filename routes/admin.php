<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\RegisterController;
use App\Http\Controllers\Backend\Auth\VerificationController;
use App\Http\Controllers\Backend\Auth\ResetPasswordController;
use App\Http\Controllers\Backend\Auth\ForgotPasswordController;




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


Route::prefix('admin')->name('admin.')->group(function(){
    // Authentication Routes..

Route::get('/good', function () {

    return 'good';
});
    Route::get('login',                            [ LoginController::class,'showLoginForm'])->name('show_login_form');
    Route::post('login',                            [ LoginController::class,'login'])->name('login');
    Route::post('logout',                           [ LoginController::class,'logout'])->name('logout');
    Route::get('register',                          [ RegisterController::class,'showRegistrationForm'])->name('show_register_form');
    Route::post('register',                         [ RegisterController::class,'register'])->name('register');
    Route::get('password/reset',                    [ ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
    Route::post('password/email',                   [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}',            [ ResetPasswordController::class,'showResetForm'])->name('password.reset');
    Route::post('password/reset',                   [ ResetPasswordController::class,'reset'])->name('password.update');
    Route::get('email/verify',                      [VerificationController::class,'show'])->name('verification.notice');
    Route::get('email/verify/{id}/{hash}',         [ VerificationController::class,'verify'])->name('verification.verify');
    Route::post('email/resend',                     [ VerificationController::class,'resend'])->name('verification.resend');
     Route::get('/dashboard',function(){

        return 'admin dashboard';

     } )->name('dashboard');
});
