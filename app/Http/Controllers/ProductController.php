<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return $this->showAllProducts();
    }

    public function show($id)
    {
        $product = Product::find($id);
        if($product) {
            return view('products.show', [
                'product' => Product::find($id),
                'images' => Image::all(),
            ]);
        }
        return $this->showAllProducts();
    }

    public function showAllProducts()
    {
        $categoriesIer = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        $products = Product::all()/*->simplePaginate(15)*/;
        $products1 = DB::table('products')->simplePaginate(6);

        return view('products.list', [
            'products' => $products1,
            'images' => Image::all(),
            'categoriesIer' => $categoriesIer,

        ]);
    }
}
