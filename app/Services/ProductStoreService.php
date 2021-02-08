<?php

namespace App\Services;

use App\CategoryProduct;
use App\Http\Requests\StoreProductRequest;

class ProductStoreService
{
    public function store(StoreProductRequest $request, $product)
    {
        $logo = null;

        if ($product->logo_image) {
            $logo = $product->logo_image;
        }

        $product->fill($request->post());

        if ($request->has('logo_image')) {
            if ($logo) {
                $image_path = public_path() . '/img/logo/' . $logo;
                unlink($image_path);
            }
            $image = $request->file('logo_image');
            $product->logo_image = $image->getClientOriginalName();
            $image->move(public_path('img/logo'), $image->getClientOriginalName());
        } else {
            $product->logo_image = $logo;
        }

        $product->save();

        if ($request->post('categories')) {

            CategoryProduct::where('product_id', $product->id)->delete();

            foreach ($request->post('categories') as $category) {
                $categoryProduct = new CategoryProduct();
                $categoryProduct->product_id = $product->id;
                $categoryProduct->category_id = $category;
                $categoryProduct->save();
            }
        }
    }
}
