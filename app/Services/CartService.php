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
        if (!empty($sessionCart->product_rows)) {
            foreach ($sessionCart->product_rows as $row) {
                if ($row['product_id'] == $id) {
                    $isNotInCart = false;
                }
            }
        }

        if ($sessionCart->product_rows === null) {
            $sessionCart->product_rows = [];
        }

        if ($isNotInCart) {
            array_push($sessionCart->product_rows, [
                'product_id' => $product->id,
                'product_name' => $product->product_name,
                'product_logo' => $product->logo_image,
                'product_quantity' => 1,
                'product_price' => $product->price,
                'product_row_price' => $product->price
            ]);
        }

        Session::put('cart', $sessionCart);
        return true;
    }

    public function deleteFromCart($id)
    {
        $sessionCart = Session::get('cart');
        $indexToDelete = 0;

        for ($i = 0; $i < count($sessionCart->product_rows); $i++ ) {
            if ($sessionCart->product_rows[$i]['product_id'] == $id) {
                $indexToDelete = $i;
            }
        }
        unset($sessionCart->product_rows[$indexToDelete]);

        $sessionCart->product_rows = array_slice($sessionCart->product_rows, 0);
        Session::put('cart', $sessionCart);
        return true;
    }

    public function calculate($request)
    {
        $totalProductsPrice = 0;
        $totalAmount = 0;
        $sessionCart = Session::get('cart');

        if (Session::has('logined_user_id')) {
            $sessionCart->user_id = Session::get('logined_user_id');
        }

        if($request->post('promocode')) {
            $promocode = Promocode::where('promocode_name', $request->post('promocode'))->first();
            if ($promocode) {
                $sessionCart->promocode_id = $promocode->id;
                $sessionCart->promocode_value = $promocode->promocode_value;
            }
        }

        $listOfQuantities = $request->post('quantity');

        if ($request->post('product_ids')) {
            for ($i = 0; $i < count($request->post('product_ids')); $i++) {
                $sessionCart->product_rows[$i]['product_quantity'] = $listOfQuantities[$i];
                $sessionCart->product_rows[$i]['product_row_price'] = $listOfQuantities[$i] * $sessionCart->product_rows[$i]['product_price'];
                $totalProductsPrice += $sessionCart->product_rows[$i]['product_row_price'];
            }

            $promocodeDiscountSum = ($sessionCart->promocode_value * $totalProductsPrice)/100;
            $totalProductsPrice = $totalProductsPrice - $promocodeDiscountSum;
        }


        $totalAmount = $totalProductsPrice + self::getDeliverySum($request->post('delivery_id'));
        $sessionCart->delivery_id = $request->post('delivery_id');
        $sessionCart->totalProducts = $totalProductsPrice;
        $sessionCart->totalAmount = $totalAmount;

        Session::put('cart', $sessionCart);
        return true;
    }

    public function editOneRow($product_id, $quantity)
    {
        $sessionCart = Session::get('cart');
        $new_row_price = 0;
        for ($i = 0; $i < count($sessionCart->product_rows); $i++) {
            if ($sessionCart->product_rows[$i]['product_id'] == $product_id) {
                $sessionCart->product_rows[$i]['product_quantity'] = $quantity;
                $new_row_price = $sessionCart->product_rows[$i]['product_row_price'] = $sessionCart->product_rows[$i]['product_price'] * $quantity;
            }
        }
        Session::put('cart', $sessionCart);

        $this->recalculateCart();
        return $new_row_price;
    }

    public function recalculateCart()
    {
        $sessionCart = Session::get('cart');
        $totalProductsPrice = 0;
        $promocodeDiscountSum = 0;

        if (!empty($sessionCart->product_rows)) {
            for ($i = 0; $i < count($sessionCart->product_rows); $i++) {
                $totalProductsPrice += $sessionCart->product_rows[$i]['product_row_price'];
            }
        }

        if (!empty($sessionCart->promocode_value)) {
            $promocodeDiscountSum = ($sessionCart->promocode_value * $totalProductsPrice)/100;
        }
        $sessionCart->totalProducts = $totalProductsPrice - $promocodeDiscountSum;
        $sessionCart->totalAmount = $sessionCart->totalProducts + self::getDeliverySum($sessionCart->delivery_id);
        Session::put('cart', $sessionCart);
    }

    public function changeDelivery($delivery_id)
    {
        $sessionCart = Session::get('cart');
        $sessionCart->delivery_id = $delivery_id;
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

    public function setPromo($promo_text)
    {
        $sessionCart = Session::get('cart');
        $promocode = Promocode::where('promocode_name', $promo_text)->first();
        if ($promocode) {
            $sessionCart->promocode_id = $promocode->id;
            $sessionCart->promocode_value = $promocode->promocode_value;
        }
        $this->recalculateCart();
    }
}
