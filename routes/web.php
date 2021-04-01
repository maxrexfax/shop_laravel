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

    Route::prefix('/admin')->group(function() {
        Route::get('/', 'AdminController@index')->name('admin');
        Route::get('/category/list', 'AdminController@categoryList')->name('admin.category.list');
        Route::get('/currencies/list', 'AdminController@currencyList')->name('admin.currency.list');
        Route::get('/deliveries/list', 'AdminController@deliveriesList')->name('admin.deliveries.list');
        Route::get('/locales/list', 'AdminController@localesList')->name('admin.locales.list');
        Route::get('/orders/list', 'AdminController@ordersList')->name('admin.orders.list');
        Route::get('/paymethod/list', 'AdminController@paymethodList')->name('admin.paymethod.list');
        Route::get('/product/list', 'AdminController@productList')->name('admin.product.list');
        Route::get('/promocodes/list', 'AdminController@promocodesList')->name('admin.promocodes.list');
        Route::get('/stores/list', 'AdminController@storeList')->name('admin.stores.list');
        Route::get('/users/list', 'AdminController@userList')->name('admin.users.list');
    });

    Route::prefix('/cart')->group(function() {
        Route::get('/', 'CartController@cart')->name('cart');
        Route::get('/checkout', 'CartController@checkoutCart')->name('cart.checkout');
        Route::get('/show/order/{uniq_id}', 'CartController@showOrder')->name('cart.show.order');
        Route::post('/checkout/check', 'OrderController@store')->name('cart.checkout.check');
        Route::get('/add/{id?}', 'CartController@addProductToCart')->name('cart.add');
        Route::get('/delete/{id?}', 'CartController@deleteProductFromCart')->name('cart.delete');
        Route::match(['get', 'post'], '/calculate', 'CartController@calculate')->name('cart.calculate');
        Route::match(['get', 'post'], '/edit', 'CartController@edit')->name('cart.edit');
        Route::match(['get', 'post'], '/changedelivery', 'CartController@changeDelivery')->name('cart.changedelivery');
        Route::get('/data', 'CartController@data')->name('cart.data');
        Route::get('/productquantity', 'CartController@cartProductQuantity')->name('cart.productquantity');
        Route::get('/reset', 'CartController@reset')->name('cart.reset');
        Route::get('/paymentdetails/{path}','CartController@getPaymentDetails');
    });

    Route::prefix('/category')->group(function() {
        Route::get('/create/{id?}', 'CategoryController@create')->name('category.create');
        Route::get('/root/list', 'CategoryController@categoriesRootList')->name('category.rootlist');
        Route::post('/store/{id?}', 'CategoryController@store')->name('category.store');
        Route::get('/destroy/{id}', 'CategoryController@destroy')->name('category.destroy');
        Route::get('/list', 'CategoryController@list')->name('category.list');
    });

    Route::prefix('/currency')->group(function() {
        Route::get('/create/{id?}', 'CurrencyController@create')->name('currency.create');
        Route::post('/store/{id?}', 'CurrencyController@store')->name('currency.store');
        Route::get('/destroy/{id?}', 'CurrencyController@destroy')->name('currency.destroy');
    });

    Route::prefix('/delivery')->group(function() {
        Route::get('/create/{id?}', 'DeliveryController@create')->name('delivery.create');
        Route::post('/store/{id?}', 'DeliveryController@store')->name('delivery.store');
        Route::get('/destroy/{id?}', 'DeliveryController@destroy')->name('delivery.destroy');
    });

    Route::prefix('/locale')->group(function() {
        Route::get('/create/{id?}', 'LocaleController@create')->name('locale.create');
        Route::post('/store/{id?}', 'LocaleController@store')->name('locale.store');
        Route::get('/destroy/{id?}', 'LocaleController@destroy')->name('locale.destroy');
    });

    Route::prefix('/order')->group(function() {
        Route::get('/softdelete/{id}', 'OrderController@softDelete')->name('order.softdelete');
        Route::get('/destroy/{id}', 'OrderController@destroy')->name('order.destroy');
        Route::post('/store/{id?}', 'OrderController@store')->name('order.store');
        Route::get('/show/{id}', 'OrderController@show')->name('order.show');
        Route::get('/create/{id?}', 'OrderController@create')->name('order.create');
    });

    Route::prefix('/paymethod')->group(function() {
        Route::get('/create/{id?}', 'PaymentMethodController@create')->name('payment.method.create');
        Route::post('/store/{id?}', 'PaymentMethodController@store')->name('payment.method.store');
        Route::get('/destroy/{id?}', 'PaymentMethodController@destroy')->name('payment.destroy');
    });

    Route::prefix('/phone')->group(function() {
        Route::get('/create/{store_id?}/{phone_id?}', 'PhoneController@create')->name('phone.create');
        Route::post('/store/{id?}', 'PhoneController@store')->name('phone.store');
        Route::get('/delete/{id}', 'PhoneController@destroy')->name('phone.delete');
    });

    Route::prefix('/product')->group(function() {
        Route::get('/category/{id}', 'CategoryController@show')->name('product.category');
        Route::get('/productsList/{id}', 'ProductController@productsList')->name('product.productsList');
        Route::get('/create/{id?}', 'ProductController@create')->name('product.create');
        Route::get('/images/{id}', 'ProductController@images')->name('product.images');
        Route::get('/show/{id}', 'ProductController@show')->name('product.show');
        Route::post('/store/{id?}', 'ProductController@store')->name('product.store');
        Route::get('/destroy/{id}', 'ProductController@destroy')->name('product.destroy');
        Route::get('/info/{id}', 'ProductController@productInfo')->name('product.info');
    });

    Route::prefix('/promocode')->group(function() {
        Route::get('/create/{id?}', 'PromocodeController@create')->name('promocode.create');
        Route::post('/store/{id?}', 'PromocodeController@store')->name('promocode.store');
        Route::get('/delete/{id}', 'PromocodeController@delete')->name('promocode.delete');
    });

    Route::prefix('/store')->group(function() {
        Route::get('/create/{id?}', 'StoreController@create')->name('store.create');
        Route::post('/store/{id?}', 'StoreController@store')->name('store.store');
        Route::post('/locales/store/{id?}', 'StoreController@storeLocales')->name('store.locales.store');
        Route::post('/currency/store/{id?}', 'StoreController@storeCurrency')->name('store.currency.store');
        Route::post('/delivery/store/{id?}', 'StoreController@storeDelivery')->name('store.delivery.store');
        Route::get('/phonelist/{id}', 'StoreController@phoneList')->name('store.phonelist');
        Route::get('/langlist/{id}', 'StoreController@languageList')->name('store.langlist');
        Route::get('/currencylist/{id}', 'StoreController@currencyList')->name('store.currencylist');
        Route::get('/changeactive/{id}', 'StoreController@changeActive')->name('store.changeactive');
        Route::get('/deliverylist/{id}', 'StoreController@deliveryList')->name('store.deliverylist');
    });

    Route::prefix('/user')->group(function() {
        Route::get('/delete/{id}', 'UserController@destroy')->name('user.delete');
        Route::get('/create/{id?}', 'UserController@create')->name('user.create');
        Route::post('/store/{id?}', 'UserController@store')->name('user.store');
        Route::get('/destroy/{id?}', 'UserController@destroy')->name('user.destroy');
    });

    Route::prefix('/image')->group(function() {
        Route::get('/delete/{id}', 'ImageController@delete')->name('image.delete');
        Route::post('/store', 'ImageController@store')->name('image.store');
        Route::post('/order', 'ImageController@changeSortOrder')->name('image.order');
    });
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

Auth::routes();

