<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'CategoryController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'UserController@index')->name('users');

Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/category/create/{id?}', 'CategoryController@create')->name('category.create');
Route::get('/admin/category/list', 'AdminController@categoryList')->name('admin.category.list');
Route::post('/category/store/{id?}', 'CategoryController@store')->name('category.store');
Route::get('/product/create/{id?}', 'ProductController@create')->name('product.create');
Route::get('/admin/product/list', 'AdminController@productList')->name('admin.product.list');
Route::post('/product/store/{id?}', 'ProductController@store')->name('product.store');

Route::post('/image/store', 'ImageController@store')->name('image.store');
Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::post('/image/order', 'ImageController@changeSortOrder')->name('image.order');

Route::get('/product/images/{id}', 'ProductController@images')->name('product.images');
Route::get('/product/category/{id}', 'CategoryController@show')->name('product.category');

Route::get('/product/show/{id}', 'ProductController@show')->name('product.show');
