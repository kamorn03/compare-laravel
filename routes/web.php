<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\LoginController as LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Route::view('/', 'home');
Route::get('/', 'App\Http\Controllers\CartController@shop')->name('shop');
Auth::routes();

// user register
Route::post('users/store', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::get('users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');

// more-about
Route::get('more-about', [App\Http\Controllers\MoreAboutController::class, 'show'])->name('more-about');

Route::get('/login/digiso-admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/login/blogger', [LoginController::class,'showBloggerLoginForm']);

Route::get('/register/digiso-admin', [RegisterController::class,'showAdminRegisterForm']);
Route::get('/register/blogger', [RegisterController::class,'showBloggerRegisterForm']);

Route::post('/login/digiso-admin', [LoginController::class,'adminLogin']);
Route::post('/login/blogger', [LoginController::class,'bloggerLogin']);

Route::post('/register/digiso-admin', [RegisterController::class,'createAdmin']);
Route::post('/register/blogger', [RegisterController::class,'createBlogger']);

Route::group(['middleware' => 'auth:blogger'], function () {
    Route::view('/blogger', 'blogger');
});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/digiso-admin', 'admin');
});

Route::get('logout', [AuthLoginController::class,'logout']);