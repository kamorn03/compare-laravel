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
use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\RegisterController as RegisterController;
use App\Http\Controllers\UserController;


Route::post('verify-payment', 'App\Http\Controllers\CartController@VerifyPayment')->name('cart.verify-payment');
Route::get('finish', 'App\Http\Controllers\CartController@finish')->name('cart.finish');
// // Route::view('/', 'home');
Route::group(['middleware' => ['guest']], function () {
    Auth::routes();
    // home
    Route::get('/', 'App\Http\Controllers\CartController@shop')->name('home');
    // shipping
    Route::get('shipping', [App\Http\Controllers\CartController::class, 'shipping'])->name('cart.shipping');
    // more-about
    Route::get('more-about', [App\Http\Controllers\MoreAboutController::class, 'show'])->name('more-about');
    
    // user register
    Route::post('users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    
    // news 
    Route::get('news', [App\Http\Controllers\NewsController::class, 'index'])->name('news');
    Route::get('news/{id}/more', [App\Http\Controllers\NewsController::class, 'newsMore'])->name('news.more');
    
    // contact
    Route::get('contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
    
    Route::get('/login/digiso-admin', [LoginController::class, 'showAdminLoginForm']);
    Route::get('/login/blogger', [LoginController::class,'showBloggerLoginForm']);
    
    Route::get('/register/digiso-admin', [RegisterController::class,'showAdminRegisterForm']);
    Route::get('/register/blogger', [Regiter::class,'showBloggerRegisterForm']);
    
    Route::post('/login/digiso-admin', [LoginController::class,'adminLogin']);
    

    // slug show product paginate
    Route::get('shop/{category}', 'App\Http\Controllers\ProductController@ShowProductCategories')->name('shop.category');
    Route::get('shop/{category}/{collection}', 'App\Http\Controllers\ProductController@ShowProductCollections')->name('shop.collection');
    Route::get('shop/{category}/{collection}/{slug}', 'App\Http\Controllers\ProductController@show')->name('shop.show');
    
    
    Route::get('cart', 'App\Http\Controllers\CartController@cart')->name('cart.index');
    Route::post('add', 'App\Http\Controllers\CartController@add')->name('cart.store');
    Route::post('update', 'App\Http\Controllers\CartController@update')->name('cart.update');

    Route::post('update/all', 'App\Http\Controllers\CartController@updateAll')->name('cart.update.all');

    Route::post('remove', 'App\Http\Controllers\CartController@remove')->name('cart.remove');
    Route::get('get/remove', 'App\Http\Controllers\CartController@TESTremove')->name('cart.get.remove');
    Route::post('clear', 'App\Http\Controllers\CartController@clear')->name('cart.clear');
    Route::get('checkout', 'App\Http\Controllers\CartController@checkout')->name('cart.checkout');
    
    // register blogger
    // Route::post('/register/digiso-admin', [RegisterController::class,'createAdmin']);
    Route::post('/login/blogger', [LoginController::class,'bloggerLogin'])->name('blogger.login');;
    Route::post('/register/blogger', [RegisterController::class,'createBlogger']);
    
    // api
    Route::post('product/add', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
    Route::post('product/update',  [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
    
    // main-title
    Route::post('main-title/upload',[App\Http\Controllers\MainTitleController::class, 'upload'])->name('main-title.upload');
    Route::post('main-title/update', [App\Http\Controllers\MainTitleController::class, 'update'])->name('main-title.update');
    Route::get('main-title/fetch', [App\Http\Controllers\MainTitleController::class, 'fetch'])->name('main-title.fetch');
    Route::get('main-title/delete', [App\Http\Controllers\MainTitleController::class, 'delete'])->name('main-title.delete');

    Route::get('product/image/{id}/fetch', [App\Http\Controllers\ProductController::class, 'fetch'])->name('product.image.fetch');
    Route::post('product/{id}/upload/image', [App\Http\Controllers\ProductController::class, 'upload'])->name('product.upload.image');
    Route::get('product/image/delete', [App\Http\Controllers\ProductController::class, 'deleteImage'])->name('product.image.delete');
    
});


Route::group(['middleware' => 'auth:blogger'], function () {
    // Route::get('/', 'App\Http\Controllers\CartController@shop')->name('home');
    // Route::get('more-about', [App\Http\Controllers\MoreAboutController::class, 'show'])->name('more-about');
    Route::view('/blogger', 'blogger');
    Route::post('users/update/{id}/address', [App\Http\Controllers\UserController::class, 'updateAddress'])->name('users.update.address');
    // users
    Route::resource('users',  UserController::class , ['except' => [ 'create' , 'store' ,'showOrder','changePassword','updatePassword']]);
    Route::get('users/change/{user}/password',  [App\Http\Controllers\UserController::class, 'changePassword'])->name('users.change.password');
    Route::post('users/update/{id}/password',  [App\Http\Controllers\UserController::class, 'updatePassword'])->name('users.update.password');
    Route::get('users/cart/order',  [App\Http\Controllers\UserController::class, 'showOrder'])->name('users.cart.order');
  
    Route::post('confirm', [App\Http\Controllers\CartController::class, 'confirm'])->name('cart.confirm');
    Route::get('complete',  [App\Http\Controllers\CartController::class, 'complete'])->name('cart.complete');

});

// api
Route::post('category/add', 'App\Http\Controllers\CategoryController@store')->name('category.store');
Route::post('category/update', 'App\Http\Controllers\CategoryController@update')->name('category.update');

// api
Route::post('collection/add', [App\Http\Controllers\CollectionController::class, 'store'])->name('collection.store');
Route::post('collection/update',  [App\Http\Controllers\CollectionController::class, 'update'])->name('collection.update');

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
        Route::get('digiso-admin/users/{id}/show', [App\Http\Controllers\AdminController::class, 'userShow'])->name('users.show');

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
        // Route::get('digiso-admin/collection/{id}/edit', [App\Http\Controllers\CollectionController::class, 'collectionEdit'])->name('collection.edit');
        Route::get('digiso-admin/collection/{id}/delete', [App\Http\Controllers\CollectionController::class, 'destroy'])->name('collection.delete');
        Route::post('digiso-admin/collection/{category_id}/list', [App\Http\Controllers\CollectionController::class, 'collectionGetList'])->name('collection.list');

        // product 
        Route::get('digiso-admin/product', [App\Http\Controllers\AdminController::class, 'product'])->name('product');
        // product api
        Route::get('digiso-admin/product', [App\Http\Controllers\AdminController::class, 'product'])->name('product');
        Route::get('digiso-admin/product/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
        Route::get('digiso-admin/product-list', [App\Http\Controllers\AdminController::class, 'productList'])->name('product.list');
        Route::get('digiso-admin/product-add', [App\Http\Controllers\AdminController::class, 'productAdd'])->name('product.add');
        Route::get('digiso-admin/product/{id}/add_image', [App\Http\Controllers\AdminController::class, 'productImage'])->name('product.add_image'); 

        // product size api
        Route::get('digiso-admin/product/{id}/size', [App\Http\Controllers\SizeController::class, 'index'])->name('product.size');
        Route::get('digiso-admin/product/{id}/size/list', [App\Http\Controllers\SizeController::class, 'sizeList'])->name('product.size.list');
        Route::get('digiso-admin/product/{id}/size/add', [App\Http\Controllers\SizeController::class, 'sizeAdd'])->name('product.size.add');
        Route::get('digiso-admin/product/{product}/size/{id}/edit', [App\Http\Controllers\SizeController::class, 'sizeEdit'])->name('product.size.edit');
        Route::get('digiso-admin/product/{product}/size/{id}/delete', [App\Http\Controllers\SizeController::class, 'destroy'])->name('product.size.delete');
        // Route::get('digiso-admin/size', [App\Http\Controllers\SizeController::class, 'index'])->name('size');
        // order
        Route::get('digiso-admin/order/{status}', [App\Http\Controllers\AdminController::class, 'order'])->name('order');
        // banner
        Route::get('digiso-admin/banner', [App\Http\Controllers\BannerController::class, 'index'])->name('banner');
        Route::post('digiso-admin/banner/update', [App\Http\Controllers\BannerController::class, 'update'])->name('banner.update');
        // size
        Route::post('digiso-admin/size/add', [App\Http\Controllers\SizeController::class, 'store'])->name('size.store');
        Route::post('digiso-admin/size/update',  [App\Http\Controllers\SizeController::class, 'update'])->name('size.update');
        Route::get('digiso-admin/size', [App\Http\Controllers\SizeController::class, 'index'])->name('size');
        Route::get('digiso-admin/size-list', [App\Http\Controllers\SizeController::class, 'sizeList'])->name('size.list');
        Route::get('digiso-admin/size/add', [App\Http\Controllers\SizeController::class, 'sizeAdd'])->name('size.add');
        Route::get('digiso-admin/size/{id}/edit', [App\Http\Controllers\SizeController::class, 'sizeEdit'])->name('size.edit');
        Route::get('digiso-admin/size/{id}/delete', [App\Http\Controllers\SizeController::class, 'destroy'])->name('size.delete');

        // news
        Route::get('digiso-admin/news', [App\Http\Controllers\NewsController::class, 'show'])->name('news');

        Route::post('digiso-admin/news-store', [App\Http\Controllers\NewsController::class, 'store'])->name('news.store');
        Route::post('digiso-admin/news-update', [App\Http\Controllers\NewsController::class, 'update'])->name('news.update');
        Route::get('digiso-admin/news/{id}/edit', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
        Route::get('digiso-admin/news/{id}/delete', [App\Http\Controllers\NewsController::class, 'destroy'])->name('news.delete');


        Route::get('digiso-admin/news-add', [App\Http\Controllers\NewsController::class, 'newsAdd'])->name('news.add');
        Route::get('digiso-admin/news-list', [App\Http\Controllers\NewsController::class, 'newsList'])->name('news.list');

        // order
        Route::get('digiso-admin/order/{status}', [App\Http\Controllers\AdminController::class, 'order'])->name('order');
        Route::get('digiso-admin/order-list/{status}', [App\Http\Controllers\AdminController::class, 'orderList'])->name('order.list');


    });

});

Route::get('logout', [AuthLoginController::class,'logout']);
