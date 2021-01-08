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
Route::get('/admin/categories', 'AdminController@categories')->name('categories');
Route::match(['get', 'post'],'/admin/categories/create', 'AdminController@categoryCreate')->name('admin.categories.create');
Route::get('/admin/categories/edit/{id?}', 'AdminController@categoryEdit')->name('admin.categories.edit');
Route::post('/admin/savecategory', 'AdminController@categorySave')->name('admin.savecategory');

Route::get('/product/show/{id?}', 'ProductController@show')->name('product.show');
