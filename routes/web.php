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

Route::get('/', 'HomeController@index')->name('main.page');

Auth::routes();

Route::get('/home', 'HomeController@home')->name('home');

Route::get('/users', 'UserController@index')->name('users');

Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/admin/category/list', 'AdminController@categoryList')->name('admin.category.list');
Route::get('/admin/product/list', 'AdminController@productList')->name('admin.product.list');
Route::get('/admin/users/list', 'AdminController@userList')->name('admin.users.list');


Route::get('/category/create/{id?}', 'CategoryController@create')->name('category.create');
Route::get('/categories/root/list', 'CategoryController@categoriesRootList')->name('category.rootlist');
Route::post('/category/store/{id?}', 'CategoryController@store')->name('category.store');

Route::get('/product/category/{id}', 'CategoryController@show')->name('product.category');

Route::get('/product/create/{id?}', 'ProductController@create')->name('product.create');
Route::get('/product/images/{id}', 'ProductController@images')->name('product.images');
Route::get('/product/show/{id}', 'ProductController@show')->name('product.show');
Route::post('/product/store/{id?}', 'ProductController@store')->name('product.store');

Route::get('/user/delete/{id}', 'UserController@destroy')->name('user.delete');
Route::get('/user/create/{id?}', 'UserController@create')->name('user.create');
Route::get('/user/store/{id?}', 'UserController@edit')->name('user.create');

Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::post('/image/store', 'ImageController@store')->name('image.store');
Route::post('/image/order', 'ImageController@changeSortOrder')->name('image.order');


