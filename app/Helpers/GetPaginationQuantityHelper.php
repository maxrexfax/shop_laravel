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
            $paginateQuantity = $request->get('paginateQuantity');
        }
        return $paginateQuantity;
    }
}
