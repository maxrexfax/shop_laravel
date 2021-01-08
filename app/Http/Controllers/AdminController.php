<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return 'admin';
    }

    public function categories()
    {
        $categoriesIer = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        $categories = Category::all()->sortBy('sort_number');
        return view('admin.categories', [
            'categories' => $categories,
            'categoriesIer' => $categoriesIer
        ]);
    }

    public function categoryEdit($id)
    {
        return view('admin.edit_category', [
            'category' => Category::find($id),
            'categories' => Category::all()
        ]);
    }

    public function categorySave(Request $request)
    {
        $category = Category::find($request->post('id'));
        $category->category_name = $request->post('category_name');
        $category->sort_number = $request->post('sort_number');

        if($request->post('category_id') == 0) {
            $category->category_id=NULL;
        } else {
            $category->category_id=$request->post('category_id');
        }

        $category->save();

        return redirect('admin/categories');
    }

    public function categoryCreate(Request $request)
    {
        if($request->post()) {
            Category::create([
               'category_name' => $request->post('category_name'),
               'sort_number' => $request->post('sort_number'),
                'category_id' => $request->post('category_id') ? $request->post('category_id') : null
            ]);
            return redirect('admin/categories');
        }
        $categories = Category::all();
        return view('admin.create_category', [
            'categories' => $categories
        ]);
    }
}
