<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// api
Route::post('category/add', 'App\Http\Controllers\CategoryController@store')->name('category.store');
Route::post('category/update', 'App\Http\Controllers\CategoryController@update')->name('category.update');

// api
Route::post('collection/add', [App\Http\Controllers\CollectionController::class, 'store'])->name('collection.store');
Route::post('collection/update',  [App\Http\Controllers\CollectionController::class, 'update'])->name('collection.update');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
