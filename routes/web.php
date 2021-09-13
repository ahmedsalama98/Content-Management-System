<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Post\PostController;
use App\Http\Controllers\Frontend\User\UserController;
use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\MainPage\HomeController;
use App\Http\Controllers\Frontend\Comment\CommentController;
use App\Http\Controllers\Frontend\MainPage\AuthorController;
use App\Http\Controllers\Frontend\MainPage\AboutUsController;
use App\Http\Controllers\Frontend\MainPage\ArchiveController;
use App\Http\Controllers\Frontend\Auth\VerificationController;
use App\Http\Controllers\Frontend\MainPage\CategoryController;
use App\Http\Controllers\Frontend\Auth\ResetPasswordController;
use App\Http\Controllers\Frontend\MainPage\ContactUsController;
use App\Http\Controllers\Frontend\MainPage\OurVisionController;
use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;

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

// Authentication Routes...
Route::get('/login',                            [ LoginController::class,'showLoginForm'])->name('login');
Route::post('login',                            [ LoginController::class,'login'])->name('login.store');
Route::post('logout',                           [ LoginController::class,'logout'])->name('logout');
Route::get('register',                          [ RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('register',                         [ RegisterController::class,'register'])->name('register.store');
Route::get('password/reset',                    [ ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
Route::post('password/email',                   [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}',            [ ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset',                   [ ResetPasswordController::class,'reset'])->name('password.update');
Route::get('email/verify',                      [VerificationController::class,'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}',         [ VerificationController::class,'verify'])->name('verification.verify');
Route::post('email/resend',                     [ VerificationController::class,'resend'])->name('verification.resend');

//home page
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

//category
Route::get('/category/{slug}', [CategoryController::class, 'index'])->name('category.show');
//author
Route::get('/author/{username}', [AuthorController::class, 'index'])->name('author.show');
//archive
Route::get('/archieve/{date}', [ArchiveController::class, 'index'])->name('archieve.show');


//about us
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');
//our-vision
Route::get('/our-vision', [OurVisionController::class, 'index'])->name('our-vision');

//contact-us
Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us');
Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contact-us.store');




//user dashboard
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
Route::get('/update-info', [UserController::class, 'updateInformationShow'])->name('user.update-info.show');
Route::post('/update-info', [UserController::class, 'updateInformationStore'])->name('user.update-info.store');
Route::get('/update-password', [UserController::class, 'updatePasswordShow'])->name('user.update-password.show');
Route::post('/update-password', [UserController::class, 'updatePasswordStore'])->name('user.update-password.store');


//comment
Route::post('/{post}/add-comment', [CommentController::class, 'store'])->name('comment.store');
Route::put('comment/{comment}/update', [CommentController::class, 'update'])->name('comment.update');
Route::delete('comment/{comment}/destroy', [CommentController::class, 'destroy'])->name('comment.destroy');

//post
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::put('/post/{post}/update', [PostController::class, 'update'])->name('post.update');
Route::delete('/post/{post}/destroy', [PostController::class, 'destroy'])->name('post.destroy');

Route::get('/{slug}', [PostController::class, 'show'])->name('post.show');




