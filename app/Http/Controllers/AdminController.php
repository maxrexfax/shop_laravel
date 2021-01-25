<?php

namespace App\Http\Controllers;

use App\Category;
use App\Currency;
use App\Image;
use App\Product;
use App\Store;
use App\User;

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
        return view('admin.partials._category_list', [
            'categoriesHierarchically' => $categoriesHierarchically,
            'categories' => $categories,
        ]);
    }

    public function productList()
    {
        $categoriesHierarchically = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        $products = Product::paginate(15);

        return view('admin.partials._product_list', [
            'products' => $products,
            'images' => Image::all(),
            'categoriesHierarchically' => $categoriesHierarchically,
        ]);
    }

    public function userList()
    {
        return view('admin.partials._users_list', [
            'users' => User::paginate(15),
        ]);
    }

    public function storeList()
    {
        return view('admin.partials._stores_list', [
            'stores' => Store::paginate(15),
        ]);
    }

    public function currencyList()
    {
        return view('admin.partials._currency_list', [
                'currencies' => Currency::paginate(15),
            ]
        );
    }

}
