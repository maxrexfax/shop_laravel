<?php

namespace App\Http\Controllers;

use App\Category;
use App\Currency;
use App\Delivery;
use App\Helpers\PaginationQuantityHelper;
use App\Image;
use App\Locale;
use App\Order;
use App\PaymentMethod;
use App\Product;
use App\Promocode;
use App\Store;
use App\User;
use Illuminate\Support\Facades\Lang;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function categoryList()
    {
        $categoriesHierarchically = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();

        return view('admin.partials.category._category_list', [
            'categoriesHierarchically' => $categoriesHierarchically,
            'categories' => Category::paginate(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
            'alternativeTitle' => Lang::get('messages.categories_list'),
        ]);
    }

    public function productList()
    {
        $categoriesHierarchically = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();

        return view('admin.partials.product._product_list', [
            'products' => Product::paginate(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
            'images' => Image::all(),
            'categoriesHierarchically' => $categoriesHierarchically,
            'alternativeTitle' => Lang::get('messages.product_list'),
        ]);
    }

    public function userList()
    {
        return view('admin.partials.user._users_list', [
            'users' => User::paginate(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
            'alternativeTitle' => Lang::get('messages.users_list'),
        ]);
    }

    public function storeList()
    {
        return view('admin.partials.store._stores_list', [
            'stores' => Store::paginate(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
            'alternativeTitle' => Lang::get('messages.stores_list'),
        ]);
    }

    public function currencyList()
    {
        return view('admin.partials.currency._currency_list', [
                'currencies' => Currency::paginate(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
                'alternativeTitle' => Lang::get('messages.currency_list'),
            ]
        );
    }

    public function localesList()
    {
        return view('admin.partials.locale._locales_list', [
            'locales' => Locale::paginate(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
            'alternativeTitle' => Lang::get('messages.locales_list'),
        ]);
    }

    public function deliveriesList()
    {
        return view('admin.partials.delivery._deliveries_list', [
            'deliveries' => Delivery::paginate(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
            'alternativeTitle' => Lang::get('messages.deliveries_list'),
        ]);
    }

    public function promocodesList()
    {
        return view('admin.partials.promocode._promocodes_list', [
            'promocodes' => Promocode::paginate(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
        ]);
    }

    public function paymethodList()
    {
        return view('admin.partials.paymethod._paymethods_list', [
            'paymentMethods' => PaymentMethod::paginate(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY),
            'alternativeTitle' => Lang::get('text.paymethods_list'),
        ]);
    }

    public function ordersList()
    {
        return view('admin.partials.orders._orders_list', [
            'orders' => Order::with('products')->get(),
            'alternativeTitle' => Lang::get('text.orders_list'),
        ]);
    }

}
