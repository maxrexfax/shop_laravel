<?php

namespace App\Services;

use App\Cart;
use App\Delivery;
use App\Product;
use App\Promocode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{

    public function __construct(){}

    public function addToCart($id)
    {
        $product = Product::find($id);
        $sessionCart = Session::get('cart');
        $isNotInCart = true;
        if (!empty($sessionCart->productRows)) {
            for ($i = 0; $i < count($sessionCart->productRows); $i++) {
                if ($sessionCart->productRows[$i]['productId'] == $id) {
                    $sessionCart->productRows[$i]['productQuantity']++;
                    $sessionCart->productRows[$i]['productRowPrice'] += $sessionCart->productRows[$i]['productPrice'];
                    $isNotInCart = false;
                }
            }
        }

        if ($sessionCart->productRows === null) {
            $sessionCart->productRows = [];
        }

        if ($isNotInCart) {
            array_push($sessionCart->productRows, [
                'productId' => $product->id,
                'productName' => $product->product_name,
                'productLogo' => $product->logo_image,
                'productQuantity' => 1,
                'productPrice' => $product->price,
                'productRowPrice' => $product->price
            ]);
        }

        Session::put('cart', $sessionCart);
        return true;
    }

    public function deleteFromCart($id)
    {
        $sessionCart = Session::get('cart');
        $indexToDelete = 0;

        for ($i = 0; $i < count($sessionCart->productRows); $i++ ) {
            if ($sessionCart->productRows[$i]['productId'] == $id) {
                $indexToDelete = $i;
            }
        }
        unset($sessionCart->productRows[$indexToDelete]);

        $sessionCart->productRows = array_slice($sessionCart->productRows, 0);
        Session::put('cart', $sessionCart);
        return true;
    }

    public function calculate($request)
    {
        $sessionCart = Session::get('cart');
        if($request->post('promocode')) {
            $promocode = Promocode::where('promocode_name', $request->post('promocode'))->first();
            if ($promocode) {
                $sessionCart->promocodeId = $promocode->id;
                $sessionCart->promocodeValue = $promocode->promocode_value;
            }
        }

        $totalProductsPrice = 0;
        $totalAmount = 0;

        if (Session::has('loginUserId')) {
            $sessionCart->userId = Session::get('loginUserId');
        }

        $listOfQuantities = $request->post('quantity');

        foreach ($sessionCart->productRows as $productRow) {
            $totalProductsPrice += $productRow['productRowPrice'];
        }

        if (isset($sessionCart->promocode_value)) {
            $promocodeDiscountSum = ($sessionCart->promocode_value * $totalProductsPrice)/100;
            $totalProductsPrice = $totalProductsPrice - $promocodeDiscountSum;
        }
        /*if ($request->post('product_ids')) {
            for ($i = 0; $i < count($request->post('product_ids')); $i++) {
                $sessionCart->productRows[$i]['product_quantity'] = $listOfQuantities[$i];
                $sessionCart->productRows[$i]['product_row_price'] = $listOfQuantities[$i] * $sessionCart->productRows[$i]['product_price'];
                $totalProductsPrice += $sessionCart->productRows[$i]['product_row_price'];
            }

            $promocodeDiscountSum = ($sessionCart->promocode_value * $totalProductsPrice)/100;
            $totalProductsPrice = $totalProductsPrice - $promocodeDiscountSum;
        }*/


        $totalAmount = $totalProductsPrice + self::getDeliverySum($request->post('delivery_id'));
        if ($request->post('delivery_id')) {
            $sessionCart->delivery_id = $request->post('delivery_id');
        }

        $sessionCart->totalProducts = $totalProductsPrice;
        $sessionCart->totalAmount = $totalAmount;

        Session::put('cart', $sessionCart);
        return true;
    }

    public function editOneRow($productId, $quantity)
    {
        $sessionCart = Session::get('cart');
        $newRowPrice = 0;

        for ($i = 0; $i < count($sessionCart->productRows); $i++) {
            if ($sessionCart->productRows[$i]['productId'] == $productId) {
                $sessionCart->productRows[$i]['productQuantity'] = $quantity;
                $newRowPrice = $sessionCart->productRows[$i]['productRowPrice'] = $sessionCart->productRows[$i]['productPrice'] * $quantity;
            }
        }

        Session::put('cart', $sessionCart);

        $this->recalculateCart();
        return $newRowPrice;
    }

    public function recalculateCart()
    {
        $sessionCart = Session::get('cart');

        $totalProductsPrice = 0;
        $promocodeDiscountSum = 0;

        if (!empty($sessionCart->productRows)) {
            foreach ($sessionCart->productRows as $productRow) {
                $totalProductsPrice += $productRow['productRowPrice'];
            }
        }

        if (!empty($sessionCart->promocodeValue)) {
            $promocodeDiscountSum = ($sessionCart->promocodeValue * $totalProductsPrice) / 100;
        }

        $sessionCart->totalProducts = $totalProductsPrice - $promocodeDiscountSum;
        $sessionCart->totalAmount = $sessionCart->totalProducts + self::getDeliverySum($sessionCart->deliveryId);

        Session::put('cart', $sessionCart);
    }

    public function changeDelivery($deliveryId)
    {
        $sessionCart = Session::get('cart');
        $sessionCart->deliveryId = $deliveryId;
        Session::put('cart', $sessionCart);
        $this->recalculateCart();
        return true;
    }

    public static function getDeliverySum($delivery_id)
    {
        $delivery_obj = Delivery::find($delivery_id);
        $delivery = 0;
        if ($delivery_obj) {
            $delivery = $delivery_obj->delivery_price;
        }
        return $delivery;
    }

    public function setPromo($promoText)
    {
        $sessionCart = Session::get('cart');
        $promocode = Promocode::where('promocode_name', $promoText)->first();
        if ($promocode) {
            $sessionCart->promocodeId = $promocode->id;
            $sessionCart->promocodeValue = $promocode->promocode_value;
        }
        $this->recalculateCart();
    }
}
