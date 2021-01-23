<?php

namespace App\Helpers;

use App\Http\Controllers\CategoryController;
use App\Product;

class GetProductsHelper
{
    public function getUserListBySortData($id, $sortType, $paginateQuantity)
    {
        $cmd = '';
        if ($sortType === CategoryController::ASCENDING_TYPE_OF_SORT) {
            $cmd = 'price ASC';
        } else if ($sortType === CategoryController::DESCENDING_TYPE_OF_SORT){
            $cmd = 'price DESC';
        } else {
            $cmd = 'product_name ASC';
        }

        return Product::whereHas('categories', function ($subQuery) use ($id) {
            $subQuery->where('categories.id', $id);
        })
            ->orderByRaw($cmd)
            ->paginate($paginateQuantity);
    }
}
