<?php

namespace App\Helpers;

use App\Http\Requests\StoreCategoryRequest;

class CategoryStoreHelper
{
    public function storeCategory(StoreCategoryRequest $request, $category)
    {
        $category->category_name = $request->post('category_name');
        $category->sort_number = $request->post('sort_number');
        $category->category_id = $request->post('category_id');
        $category->category_description = $request->post('category_description');
        if ($request->has('category_logo')) {
            $image = $request->file('category_logo');
            $category->category_logo = $image->getClientOriginalName();
            $image->move(public_path('img/logo'), $image->getClientOriginalName());
        }
        $category->save();
    }
}
