<?php

namespace App\Services;

use App\Cart;
use App\Category;
use App\CategoryProduct;
use App\Delivery;
use App\Product;
use App\Promocode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function addToCart($id)
    {
        $product = Product::find($id);
        $sessionCart = Session::get('cart');

        if (!empty($sessionCart->productRows) && !empty($sessionCart->productRows[$product->id])) {
            $sessionCart->productRows[$product->id]['productQuantity']++;
            $sessionCart->productRows[$product->id]['productRowPrice'] += $product->price;
        } else {
            $sessionCart->productRows[$product->id] = [
                'productName' => $product->product_name,
                'productLogo' => $product->logo_image ? $product->logo_image : '',
                'productQuantity' => 1,
                'productPrice' => $product->price,
                'productRowPrice' => $product->price
            ];
        }

        Session::put('cart', $sessionCart);
    }

    public function deleteFromCart($id)
    {
        $sessionCart = Session::get('cart');

        unset($sessionCart->productRows[$id]);

        Session::put('cart', $sessionCart);
    }

    public function calculate($request)
    {
        $sessionCart = Session::get('cart');
        if ($request->post('promocode')) {
            $promocode = Promocode::where('promocode_name', $request->post('promocode'))->first();
            if ($promocode) {
                $sessionCart->promocodeId = $promocode->id;
                $sessionCart->promocodeValue = $promocode->promocode_value;
            }
        }

        $totalProductsPrice = 0;

        if (Session::has('loginUserId')) {
            $sessionCart->userId = Session::get('loginUserId');
        }

        foreach ($sessionCart->productRows as $productRow) {
            $totalProductsPrice += $productRow['productRowPrice'];
        }

        if (isset($sessionCart->promocode_value)) {
            $promocodeDiscountSum = ($sessionCart->promocode_value * $totalProductsPrice) / 100;
            $totalProductsPrice = $totalProductsPrice - $promocodeDiscountSum;
        }

        if ($request->post('delivery_id')) {
            $sessionCart->delivery_id = $request->post('delivery_id');
        }

        $sessionCart->totalAmount = $totalProductsPrice + self::getDeliverySum($request->post('delivery_id'));
        $sessionCart->totalProducts = $totalProductsPrice;

        Session::put('cart', $sessionCart);
    }

    public function editOneRow($productId, $quantity)
    {
        $sessionCart = Session::get('cart');
        $newRowPrice = 0;

        if (isset($sessionCart->productRows[$productId])) {

            $sessionCart->productRows[$productId]['productQuantity'] = $quantity;
            $newRowPrice = $sessionCart->productRows[$productId]['productRowPrice'] = $sessionCart->productRows[$productId]['productPrice'] * $quantity;

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

    public function getAdditionalProducts()
    {
        $sessionCart = Session::get('cart');
        $arrayOfCategoryIds = [];
        $arrayOfProducts = [];
        $arrayOfProductIds = [];
        if (!empty($sessionCart->productRows)) {
            foreach ($sessionCart->productRows as $key => $productRow) {
                $arrayOfProductIds[] = $key;
                $product = Product::find($key);
                if ($product) {
                    foreach ($product->categories as $category) {
                        $arrayOfCategoryIds[] = $category->id;
                    }
                }
            }
        }

        $arrayOfCategoryIds = array_unique($arrayOfCategoryIds);
        $categories = Category::find($arrayOfCategoryIds);
        foreach ($categories as $category) {
            foreach ($category->products as $product) {
                $arrayOfProducts[] = $product;
            }
        }

        foreach ($arrayOfProducts as $key => $product) {
            if (in_array($product->id, $arrayOfProductIds)) {
                unset($arrayOfProducts[$key]);
            }
        }
        return $arrayOfProducts;
    }

}
