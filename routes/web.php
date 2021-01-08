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

Route::get('/admin', 'AdminController@index');
Route::get('/category/list', 'CategoryController@list')->name('category.list');
Route::match(['get', 'post'],'/category/create', 'CategoryController@create')->name('category.create');
Route::get('/category/edit/{id?}', 'CategoryController@edit')->name('category.edit');
Route::post('/category/update', 'CategoryController@update')->name('category.update');

Route::get('/product/show/{id?}', 'ProductController@show')->name('product.show');
Route::get('/product/category/{id?}', 'CategoryController@show')->name('category.show');


Route::get('/category/saveedit/{id?}', 'CategoryController@saveEdit')->name('category.saveedit');



Route::post('/category/store/{id?}', 'CategoryController@store')->name('category.store');
