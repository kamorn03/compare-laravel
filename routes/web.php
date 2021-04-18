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
use App\Http\Controllers\UserController;

// Route::view('/', 'home');
Route::get('/', 'App\Http\Controllers\CartController@shop')->name('home');
Auth::routes();

// user register
Route::post('users/store', [UserController::class, 'store'])->name('users.store');
Route::get('users/create', [UserController::class, 'create'])->name('users.create');

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


// slug show product paginate
Route::get('shop/{category}', 'App\Http\Controllers\ProductController@ShowProductCategories')->name('shop.category');
Route::get('shop/{category}/{collection}', 'App\Http\Controllers\ProductController@ShowProductCollections')->name('shop.collection');
Route::get('shop/{category}/{collection}/{slug}', 'App\Http\Controllers\ProductController@show')->name('shop.show');


Route::get('cart', 'App\Http\Controllers\CartController@cart')->name('cart.index');
Route::post('add', 'App\Http\Controllers\CartController@add')->name('cart.store');
Route::post('update', 'App\Http\Controllers\CartController@update')->name('cart.update');
Route::post('remove', 'App\Http\Controllers\CartController@remove')->name('cart.remove');
Route::post('clear', 'App\Http\Controllers\CartController@clear')->name('cart.clear');
Route::get('checkout', 'App\Http\Controllers\CartController@checkout')->name('cart.checkout');


// register blogger
Route::post('/register/digiso-admin', [RegisterController::class,'createAdmin']);

Route::post('/login/blogger', [LoginController::class,'bloggerLogin'])->name('blogger.login');;
Route::post('/register/blogger', [RegisterController::class,'createBlogger']);


Route::group(['middleware' => 'auth:blogger'], function () {
    Route::view('/blogger', 'blogger');
    Route::resource('users',  UserController::class , ['except' => [ 'create' , 'store']]);
});

// api
Route::post('product/add', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
Route::post('product/update',  [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');

// main-title
Route::post('main-title/upload',[App\Http\Controllers\MainTitleController::class, 'upload'])->name('main-title.upload');
Route::post('main-title/update', [App\Http\Controllers\MainTitleController::class, 'update'])->name('main-title.update');
Route::get('main-title/fetch', [App\Http\Controllers\MainTitleController::class, 'fetch'])->name('main-title.fetch');
Route::get('main-title/delete', [App\Http\Controllers\MainTitleController::class, 'delete'])->name('main-title.delete');

 // news
 Route::post('digiso-admin/news-store', [App\Http\Controllers\NewsController::class, 'store'])->name('news.store');
 Route::post('digiso-admin/news-update', [App\Http\Controllers\NewsController::class, 'update'])->name('news.update');
 Route::get('digiso-admin/news/{id}/edit', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
 Route::get('digiso-admin/news/{id}/delete', [App\Http\Controllers\NewsController::class, 'destroy'])->name('news.delete');


Route::group(['middleware' => 'auth:admin'], function () {
    /* admin path */
    Route::get('digiso-admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

    Route::namespace('Admin')->as('admin.')->group(function () {
        // main-title
        Route::get('digiso-admin/main-title',[App\Http\Controllers\MainTitleController::class, 'index'])->name('main-title');
        // more-about 
        Route::get('digiso-admin/more-about', [App\Http\Controllers\MoreAboutController::class, 'index'])->name('more-about');
        Route::post('digiso-admin/more-about/update', [App\Http\Controllers\MoreAboutController::class, 'update'])->name('more-about.update');

        // contact 
        Route::get('digiso-admin/contact', [App\Http\Controllers\ContactController::class, 'updateContact'])->name('contact');
        Route::post('digiso-admin/contact/{id}/update', [App\Http\Controllers\ContactController::class, 'update'])->name('contact.update');


        // users
        Route::get('digiso-admin/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
        // category
        Route::get('digiso-admin/category', [App\Http\Controllers\AdminController::class, 'category'])->name('category');

        Route::get('digiso-admin/category-list', [App\Http\Controllers\AdminController::class, 'categoryList'])->name('category.list');
        Route::get('digiso-admin/category/add', [App\Http\Controllers\CategoryController::class, 'categoriesAdd'])->name('category.add');
        Route::get('digiso-admin/category/{id}/edit', [App\Http\Controllers\CategoryController::class, 'categoryEdit'])->name('category.edit');
        Route::get('digiso-admin/category/{id}/delete', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.delete');

        // collection
        Route::get('digiso-admin/collection', [App\Http\Controllers\AdminController::class, 'collection'])->name('collection');
        Route::get('digiso-admin/collection/add', [App\Http\Controllers\CollectionController::class, 'collectionAdd'])->name('collection.add');
        Route::get('digiso-admin/collection-list', [App\Http\Controllers\AdminController::class, 'collectionList'])->name('collection.datalist');
        Route::post('digiso-admin/collection/{category_id}/list', [App\Http\Controllers\CollectionController::class, 'collectionGetList'])->name('collection.list');
        Route::get('digiso-admin/collection/{id}/edit', [App\Http\Controllers\AdminController::class, 'collectionUpdate'])->name('collection.edit');
        Route::get('digiso-admin/collection/{id}/edit', [App\Http\Controllers\CollectionController::class, 'collectionEdit'])->name('collection.edit');
        Route::get('digiso-admin/collection/{id}/delete', [App\Http\Controllers\CollectionController::class, 'destroy'])->name('collection.delete');
        Route::post('digiso-admin/collection/{category_id}/list', [App\Http\Controllers\CollectionController::class, 'collectionGetList'])->name('collection.list');

        // product 
        Route::get('digiso-admin/product', [App\Http\Controllers\AdminController::class, 'product'])->name('product');

        Route::get('digiso-admin/product-list', [App\Http\Controllers\AdminController::class, 'productList'])->name('product.list');
        Route::get('digiso-admin/product-add', [App\Http\Controllers\AdminController::class, 'productAdd'])->name('product.add');
        Route::get('digiso-admin/product/{id}/add_image', [App\Http\Controllers\AdminController::class, 'productImage'])->name('product.add_image'); 

        // order
        Route::get('digiso-admin/order/{status}', [App\Http\Controllers\AdminController::class, 'order'])->name('order');
        // news
        Route::get('digiso-admin/news', [App\Http\Controllers\NewsController::class, 'show'])->name('news');

        Route::get('digiso-admin/news-add', [App\Http\Controllers\NewsController::class, 'newsAdd'])->name('news.add');
        Route::get('digiso-admin/news-list', [App\Http\Controllers\NewsController::class, 'newsList'])->name('news.list');

    });

});

Route::get('logout', [AuthLoginController::class,'logout']);
