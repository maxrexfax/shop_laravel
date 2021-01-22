<?php

namespace App\Helpers;

use App\Http\Controllers\CategoryController;
use App\Product;

class GetProductsHelper
{
    public function getUserListBySortData($id, $sortType, $paginateQuantity)
    {
        if ($sortType === CategoryController::ASCENDING_TYPE_OF_SORT) {
            $products = Product::whereHas('categories', function ($subQuery) use ($id) {
                $subQuery->where('categories.id', $id);
            })
                ->orderByRaw('price ASC')
                ->paginate($paginateQuantity);
        } else if ($sortType === CategoryController::DESCENDING_TYPE_OF_SORT){
            $products = Product::whereHas('categories', function ($subQuery) use ($id) {
                $subQuery->where('categories.id', $id);
            })
                ->orderByRaw('price DESC')
                ->paginate($paginateQuantity);
        } else {
            $products = Product::whereHas('categories', function ($subQuery) use ($id) {
                $subQuery->where('categories.id', $id);
            })
                ->orderByRaw('product_name ASC')
                ->paginate($paginateQuantity);
        }
        return $products;
    }
}
