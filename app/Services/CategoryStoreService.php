<?php

namespace App\Services;

use App\Http\Requests\StoreCategoryRequest;

class CategoryStoreService
{
    public function storeCategory(StoreCategoryRequest $request, $category)
    {
        $category->category_name = $request->post('category_name');
        $category->sort_number = $request->post('sort_number');
        $category->category_id = $request->post('category_id');
        $category->category_description = $request->post('category_description');
        if ($request->has('category_logo')) {
            if ($category->category_logo) {
                $image_path = public_path() . '/img/logo/' . $category->category_logo;
                unlink($image_path);
            }

            $image = $request->file('category_logo');
            $category->category_logo = $image->getClientOriginalName();
            $image->move(public_path('img/logo'), $image->getClientOriginalName());
        }
        $category->save();
    }
}
