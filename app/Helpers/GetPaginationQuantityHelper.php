<?php

namespace App\Helpers;


class GetPaginationQuantityHelper
{
    const DEFAULT_PAGINATION_QUANTITY = 12;
    public function getPaginationQuantity($paginationQuantityToCheck)
    {
        $paginateQuantity = self::DEFAULT_PAGINATION_QUANTITY;
        if (!empty($paginationQuantityToCheck)) {
            $paginateQuantity = intval($paginationQuantityToCheck);
        }
        if (is_numeric($paginateQuantity)) {
            return $paginateQuantity;
        }
        return self::DEFAULT_PAGINATION_QUANTITY;
    }
}
