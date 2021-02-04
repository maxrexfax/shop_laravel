<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Locale;

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
Route::group(['middleware'=>'language'],function ()
{
    Route::get('/', 'HomeController@index')->name('main.page');

    Auth::routes();

    Route::get('/home', 'HomeController@home')->name('home');

    Route::get('/users', 'UserController@index')->name('users');

    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::get('/admin/category/list', 'AdminController@categoryList')->name('admin.category.list');
    Route::get('/admin/product/list', 'AdminController@productList')->name('admin.product.list');
    Route::get('/admin/users/list', 'AdminController@userList')->name('admin.users.list');
    Route::get('/admin/stores/list', 'AdminController@storeList')->name('admin.stores.list');
    Route::get('/admin/currencies/list', 'AdminController@currencyList')->name('admin.currency.list');
    Route::get('/admin/locales/list', 'AdminController@localesList')->name('admin.locales.list');
    Route::get('/admin/deliveries/list', 'AdminController@deliveriesList')->name('admin.deliveries.list');


    Route::get('/category/create/{id?}', 'CategoryController@create')->name('category.create');
    Route::get('/categories/root/list', 'CategoryController@categoriesRootList')->name('category.rootlist');
    Route::post('/category/store/{id?}', 'CategoryController@store')->name('category.store');

    Route::get('/currency/create/{id?}', 'CurrencyController@create')->name('currency.create');
    Route::post('/currency/store/{id?}', 'CurrencyController@store')->name('currency.store');

    Route::get('/delivery/create/{id?}', 'DeliveryController@create')->name('delivery.create');
    Route::post('/delivery/store/{id?}', 'DeliveryController@store')->name('delivery.store');
    Route::get('/delivery/destroy/{id?}', 'DeliveryController@destroy')->name('delivery.destroy');


    Route::get('/locale/create/{id?}', 'LocaleController@create')->name('locale.create');
    Route::post('/locale/store/{id?}', 'LocaleController@store')->name('locale.store');

    Route::get('/phone/create/{store_id?}/{phone_id?}', 'PhoneController@create')->name('phone.create');
    Route::post('/phone/store/{id?}', 'PhoneController@store')->name('phone.store');
    Route::get('/phone/delete/{id}', 'PhoneController@destroy')->name('phone.delete');

    Route::get('/product/category/{id}', 'CategoryController@show')->name('product.category');

    Route::get('/product/create/{id?}', 'ProductController@create')->name('product.create');
    Route::get('/product/images/{id}', 'ProductController@images')->name('product.images');
    Route::get('/product/show/{id}', 'ProductController@show')->name('product.show');
    Route::post('/product/store/{id?}', 'ProductController@store')->name('product.store');

    Route::get('/store/create/{id?}', 'StoreController@create')->name('store.create');
    Route::post('/store/store/{id?}', 'StoreController@store')->name('store.store');
    Route::post('/store/locales/store/{id?}', 'StoreController@storeLocales')->name('store.locales.store');
    Route::post('/store/currency/store/{id?}', 'StoreController@storeCurrency')->name('store.currency.store');
    Route::post('/store/delivery/store/{id?}', 'StoreController@storeDelivery')->name('store.delivery.store');
    Route::get('/store/phonelist/{id}', 'StoreController@phoneList')->name('store.phonelist');
    Route::get('/store/langlist/{id}', 'StoreController@languageList')->name('store.langlist');
    Route::get('/store/currencylist/{id}', 'StoreController@currencyList')->name('store.currencylist');
    Route::get('/store/changeactive/{id}', 'StoreController@changeActive')->name('store.changeactive');
    Route::get('/store/deliverylist/{id}', 'StoreController@deliveryList')->name('store.deliverylist');

    Route::get('/user/delete/{id}', 'UserController@destroy')->name('user.delete');
    Route::get('/user/create/{id?}', 'UserController@create')->name('user.create');
    Route::post('/user/store/{id?}', 'UserController@store')->name('user.store');

    Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');
    Route::post('/image/store', 'ImageController@store')->name('image.store');
    Route::post('/image/order', 'ImageController@changeSortOrder')->name('image.order');

});

Route::get('/locale/{locale}', function ($locale) {
    $validLocale = in_array($locale, Locale::all()->pluck('locale_code')->all());
    if ($validLocale) {
        App::setLocale($locale);
        Session::put('locale', $locale);
    }
    return back();
});

Route::get('/set-currency/{currency}', 'StoreController@setDefaultCurrency')->name('set.current.currency');

Route::get('/currency/reload', 'CurrencyController@reloadCurrencyValue')->name('currency.reload');
