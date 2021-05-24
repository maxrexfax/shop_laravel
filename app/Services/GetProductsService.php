<?php

namespace App\Services;

use App\Category;
use App\Product;

class GetProductsService
{
//    public function getUserListBySortData($id, $sortType, $paginateQuantity)
//    {
//        $cmd = '';
//        if ($sortType === Category::ASCENDING_TYPE_OF_SORT) {
//            $cmd = 'price ASC';
//        } else if ($sortType === Category::DESCENDING_TYPE_OF_SORT){
//            $cmd = 'price DESC';
//        } else {
//            $cmd = 'product_name ASC';
//        }
//
//        return Product::whereHas('categories', function ($subQuery) use ($id) {
//            $subQuery->where('categories.id', $id);
//        })
//            ->orderByRaw($cmd)
//            ->paginate($paginateQuantity);
//    }
}
