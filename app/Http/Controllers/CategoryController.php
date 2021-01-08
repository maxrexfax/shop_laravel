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

    public function saveEdit($id = null)
    {
        if(!empty($id)) {
            $category = Category::find($id);
            if($category) {
                return view('categories.create_edit_category', [
                    'NameOfForm' => 'Edit category '.$category->category_name,
                    'alt_title' => 'Edit category '.$category->category_name,
                    'categories' => Category::all(),
                    'category' => $category
                ]);
            } else {
                return redirect('category/list');
            }
        } else {
            return view('categories.create_edit_category', [
                'NameOfForm' => 'Create new category',
                'alt_title' => 'Create new category',
                'categories' => Category::all()
            ]);
        }
    }

    public function store($id = null, Request $request)
    {
        $category = Category::find($id);
        if($category) {
            $category->category_name = $request->post('category_name');
            $category->sort_number = $request->post('sort_number');

            if($request->post('category_id') == 0) {
                $category->category_id=NULL;
            } else {
                $category->category_id=$request->post('category_id');
            }
            $category->save();
        } else {
            Category::create([
                'category_name' => $request->post('category_name'),
                'sort_number' => $request->post('sort_number'),
                'category_id' => $request->post('category_id') ? $request->post('category_id') : null
            ]);
        }

        return redirect('category/list');

    }


    public function list()
    {
        $categoriesIer = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        $categories = Category::all()->sortBy('sort_number');
        return view('categories.categories', [
            'categories' => $categories,
            'categoriesIer' => $categoriesIer
        ]);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if($category) {
            return $category->category_name;
        } else {
            return redirect('category/list');
        }
    }

}
