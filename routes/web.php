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
        Route::get('/users/index', 'UserController@index')->name('user.index');
    });

    Route::prefix('/category')->group(function() {
        Route::get('/create', 'CategoryController@create')->name('category.create');
        Route::post('/store', 'CategoryController@store')->name('category.store');
        Route::get('/edit/{id?}', 'CategoryController@edit')->name('category.edit');
        Route::post('/update/{id?}', 'CategoryController@update')->name('category.update');
        Route::get('/root/list', 'CategoryController@categoriesRootList')->name('category.rootlist');
        Route::get('/destroy/{id}', 'CategoryController@destroy')->name('category.destroy');
        Route::get('/list', 'CategoryController@list')->name('category.list');
    });

    Route::prefix('/currency')->group(function() {
        Route::get('/create', 'CurrencyController@create')->name('currency.create');
        Route::get('/edit/{id?}', 'CurrencyController@edit')->name('currency.edit');
        Route::post('/store', 'CurrencyController@store')->name('currency.store');
        Route::post('/update/{id?}', 'CurrencyController@update')->name('currency.update');
        Route::get('/destroy/{id?}', 'CurrencyController@destroy')->name('currency.destroy');
    });

    Route::prefix('/delivery')->group(function() {
        Route::get('/create', 'DeliveryController@create')->name('delivery.create');
        Route::get('/edit/{id?}', 'DeliveryController@edit')->name('delivery.edit');
        Route::post('/store', 'DeliveryController@store')->name('delivery.store');
        Route::post('/update/{id?}', 'DeliveryController@update')->name('delivery.update');
        Route::get('/destroy/{id?}', 'DeliveryController@destroy')->name('delivery.destroy');
    });

    Route::prefix('/locale')->group(function() {
        Route::get('/create', 'LocaleController@create')->name('locale.create');
        Route::get('/edit/{id?}', 'LocaleController@edit')->name('locale.edit');
        Route::post('/store', 'LocaleController@store')->name('locale.store');
        Route::post('/update/{id?}', 'LocaleController@update')->name('locale.update');
        Route::get('/destroy/{id?}', 'LocaleController@destroy')->name('locale.destroy');
    });

    Route::prefix('/order')->group(function() {
        Route::get('/softdelete/{id}', 'OrderController@softDelete')->name('order.softdelete');
        Route::get('/destroy/{id}', 'OrderController@destroy')->name('order.destroy');
        Route::get('/show/{id}', 'OrderController@show')->name('order.show');
        Route::get('/create', 'OrderController@create')->name('order.create');
        Route::get('/edit/{id?}', 'OrderController@edit')->name('order.edit');
        Route::post('/store', 'OrderController@store')->name('order.store');
        Route::post('/update/{id?}', 'OrderController@update')->name('order.update');
    });

    Route::prefix('/paymethod')->group(function() {
        Route::get('/create', 'PaymentMethodController@create')->name('payment.method.create');
        Route::get('/edit/{id?}', 'PaymentMethodController@edit')->name('payment.method.edit');
        Route::post('/store', 'PaymentMethodController@store')->name('payment.method.store');
        Route::post('/update/{id?}', 'PaymentMethodController@update')->name('payment.method.update');
        Route::get('/destroy/{id?}', 'PaymentMethodController@destroy')->name('payment.destroy');
    });

    Route::prefix('/phone')->group(function() {
        Route::get('/create/{store_id?}', 'PhoneController@create')->name('phone.create');
        Route::get('/edit/{store_id?}/{phone_id?}', 'PhoneController@edit')->name('phone.edit');
        Route::post('/store/{id?}', 'PhoneController@store')->name('phone.store');
        Route::post('/update/{id?}', 'PhoneController@update')->name('phone.update');
        Route::get('/delete/{id}', 'PhoneController@destroy')->name('phone.delete');
    });

    Route::prefix('/product')->group(function() {
        Route::get('/category/{id}', 'CategoryController@show')->name('product.category');
        Route::get('/productsList/{id}', 'ProductController@productsList')->name('product.productsList');
        Route::get('/create', 'ProductController@create')->name('product.create');
        Route::get('/edit/{id?}', 'ProductController@edit')->name('product.edit');
        Route::get('/images/{id}', 'ProductController@images')->name('product.images');
        Route::get('/show/{id}', 'ProductController@show')->name('product.show');
        Route::post('/store', 'ProductController@store')->name('product.store');
        Route::post('/update/{id?}', 'ProductController@update')->name('product.update');
        Route::get('/destroy/{id}', 'ProductController@destroy')->name('product.destroy');
        Route::get('/info/{id}', 'ProductController@productInfo')->name('product.info');
    });

    Route::prefix('/promocode')->group(function() {
        Route::get('/create', 'PromocodeController@create')->name('promocode.create');
        Route::get('/edit/{id?}', 'PromocodeController@edit')->name('promocode.edit');
        Route::post('/store', 'PromocodeController@store')->name('promocode.store');
        Route::post('/update/{id?}', 'PromocodeController@update')->name('promocode.update');
        Route::get('/delete/{id}', 'PromocodeController@delete')->name('promocode.delete');
    });

    Route::prefix('/store')->group(function() {
        Route::get('/create', 'StoreController@create')->name('store.create');
        Route::get('/edit/{id?}', 'StoreController@edit')->name('store.edit');
        Route::post('/store', 'StoreController@store')->name('store.store');
        Route::post('/update/{id?}', 'StoreController@update')->name('store.update');
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

