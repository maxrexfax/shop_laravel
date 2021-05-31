<?php

namespace App\Services;

use App\CategoryProduct;
use App\Helpers\ImageHelper;
use App\Http\Requests\StoreProductRequest;
use App\Image;
use Illuminate\Support\Facades\Session;

class ProductStoreService
{
    public function addProductToSessionArray($id)
    {
        $arrayOfIds = Session::get('visitedProducts');
        if (is_array($arrayOfIds) && !in_array($id, $arrayOfIds)) {
            $arrayOfIds[] = $id;
            Session::put('visitedProducts', $arrayOfIds);
        }
    }
}
