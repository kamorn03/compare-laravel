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
Route::get('/', 'App\Http\Controllers\CartController@shop')->name('home');
Auth::routes();

// user register
Route::post('users/store', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::get('users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');

// more-about
Route::get('more-about', [App\Http\Controllers\MoreAboutController::class, 'show'])->name('more-about');

// news 
Route::get('news', [App\Http\Controllers\NewsController::class, 'index'])->name('news');
Route::get('news/{id}/more', [App\Http\Controllers\NewsController::class, 'newsMore'])->name('news.more');

// contact
Route::get('contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');

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
    Route::get('digiso-admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

    Route::get('digiso-admin/main-title',[App\Http\Controllers\MainTitleController::class, 'index'])->name('admin.main-title');

    Route::get('digiso-admin/more-about', [App\Http\Controllers\MoreAboutController::class, 'index'])->name('admin.more-about');

    // contact 
    Route::get('digiso-admin/contact', [App\Http\Controllers\ContactController::class, 'updateContact'])->name('admin.contact');

    Route::get('digiso-admin/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');

    Route::get('digiso-admin/category', [App\Http\Controllers\AdminController::class, 'category'])->name('admin.category');

    Route::get('digiso-admin/collection', [App\Http\Controllers\AdminController::class, 'collection'])->name('admin.collection');

    // product api
    Route::get('digiso-admin/product', [App\Http\Controllers\AdminController::class, 'product'])->name('admin.product');

    // order
    Route::get('digiso-admin/order/{status}', [App\Http\Controllers\AdminController::class, 'order'])->name('admin.order');

    Route::get('digiso-admin/news', [App\Http\Controllers\NewsController::class, 'show'])->name('admin.news');
    Route::get('digiso-admin/news-add', [App\Http\Controllers\NewsController::class, 'newsAdd'])->name('news.add');
    Route::get('digiso-admin/news-list', [App\Http\Controllers\NewsController::class, 'newsList'])->name('news.list');
    // admin path
});

Route::get('logout', [AuthLoginController::class,'logout']);
