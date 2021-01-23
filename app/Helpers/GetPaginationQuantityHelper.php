<?php

namespace App\Helpers;


use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;

class GetPaginationQuantityHelper
{
    public function getPaginationQuantity(Request $request)
    {
        $paginateQuantity = CategoryController::DEFAULT_PAGINATION_QUANTITY;
        if ($request->get('paginateQuantity')) {
            $paginateQuantity = intval($request->get('paginateQuantity'));
        }
        if (is_numeric($paginateQuantity)) {
            return $paginateQuantity;
        }
        return CategoryController::DEFAULT_PAGINATION_QUANTITY;
    }
}
