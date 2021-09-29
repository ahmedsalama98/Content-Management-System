<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\Post\PostController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Auth\RegisterController;
use App\Http\Controllers\Backend\Auth\VerificationController;
use App\Http\Controllers\Backend\Category\CategoryController;
use App\Http\Controllers\Backend\Auth\ResetPasswordController;
use App\Http\Controllers\Backend\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\Comment\CommentController;
use App\Http\Controllers\Backend\ContactMessage\ContactMessageController;
use App\Http\Controllers\Backend\IndexPage\AdminIndexPageController;
use App\Http\Controllers\Backend\Setting\SettingController;
use App\Http\Controllers\Backend\User\UserController;

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


       //indexpage
        Route::get('/index',[AdminIndexPageController::class , 'index'] )->name('index');
       //indexpage



       //posts

    //    Route::resource('post', PostController::class)->except(['create','show']);
       Route::get('posts', [PostController::class, 'index'])->name('post.index');
       Route::get('post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
       Route::put('post/{id}/update', [PostController::class, 'update'])->name('post.update');
       Route::delete('post/{id}/destroy', [PostController::class, 'destroy'])->name('post.destroy');
       //comment
       Route::resource('comment', CommentController::class)->except(['show']);

//category
       Route::resource('category', CategoryController::class)->except(['show']);
//user
       Route::resource('user', UserController::class)->except(['show']);
//admin
       Route::resource('admins', AdminController::class)->except(['show']);
//setting
       Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
       Route::put('settings/update', [SettingController::class, 'update'])->name('settings.update');


//contact-message
Route::get('contact-message',[ContactMessageController::class,'index'])->name('contact-message.index');
Route::put('contact-message/{id}/read',[ContactMessageController::class,'read'])->name('contact-message.read');
Route::delete('contact-message/{id}/destroy',[ContactMessageController::class,'destroy'])->name('contact-message.destroy');



   });




});

Route::get('/admin',function(){

    return  redirect()->route('admin.index');

 } );

