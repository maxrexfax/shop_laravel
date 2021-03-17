<?php

namespace App\Services;

use App\CategoryProduct;
use App\Helpers\ImageHelper;
use App\Http\Requests\StoreProductRequest;
use App\Image;
use Illuminate\Support\Facades\Session;

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
                (new ImageHelper())->deleteImage($logo, Image::PATH_TO_SAVE_LOGOS);
            }

            $image = $request->file('logo_image');
            $product->logo_image = $image->getClientOriginalName();

            (new ImageHelper())->storeImageFile($image, Image::PATH_TO_SAVE_LOGOS);
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

    public function addProductToSessionArray($id)
    {
        $arrayOfIds = Session::get('arrayOfVisitedProducts');
        if (is_array($arrayOfIds) && !in_array($id, $arrayOfIds)) {
            $arrayOfIds[] = $id;
            Session::put('arrayOfVisitedProducts', $arrayOfIds);
        }
    }
}
