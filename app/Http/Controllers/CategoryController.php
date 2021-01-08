<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categoriesIer = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        $categories = Category::all()->sortBy('sort_number');
        return view('categories.index', [
            'categoriesIer' => $categoriesIer,
            'categories' => $categories
        ]);
    }
}
