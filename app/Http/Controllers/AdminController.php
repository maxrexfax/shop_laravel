<?php

namespace App\Http\Controllers;

use App\Category;
use App\Currency;
use App\Delivery;
use App\Helpers\PaginationQuantityHelper;
use App\Image;
use App\Locale;
use App\Product;
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
        $categories = Category::all()->sortBy('sort_number');
        return view('admin.partials.category._category_list', [
            'categoriesHierarchically' => $categoriesHierarchically,
            'categories' => $categories,
            'alternativeTitle' => Lang::get('messages.categories_list'),
        ]);
    }

    public function productList()
    {
        $categoriesHierarchically = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        $products = Product::paginate(PaginationQuantityHelper::DEFAULT_PAGINATION_QUANTITY);

        return view('admin.partials.product._product_list', [
            'products' => $products,
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

}
