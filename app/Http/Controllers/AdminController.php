<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\Product;

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

}
