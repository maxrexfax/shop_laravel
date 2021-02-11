<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Delivery;
use App\Product;
use App\Promocode;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public $cart;

    public function __construct()
    {
        if(!session()->has('cart'))
        {
            $this->cart = new Cart();
        }

        if(Auth::check()) {
            $this->cart->user_id = Auth::id();

        } else {
            $this->cart->user_id = 0;

        }

        Session::put('cart', $this->cart);
    }

    public function cart()
    {
        //dd(Session::get('cart'));
        return view('cart.cart', [
            'activeStore' => Store::firstWhere('active', '=', Store::STORE_IS_ACTIVE),
            'cart' => Session::get('cart')
        ]);
    }

    public function addProductToCart($id)
    {
        $product = Product::find($id);
        $sessionCart = Session::get('cart');


        array_push($sessionCart->product_rows, ['product_id' => $product->id, 'product_name' => $product->product_name, 'product_logo' => $product->logo_image, 'product_quantity' => 1, 'product_price' => $product->price, 'product_row_price' => $product->price]);


        Session::put('cart', $sessionCart);

        return redirect()->back();
    }

    public function deleteProductFromCart($id)
    {
        $sessionCart = Session::get('cart');
        $filtered = $sessionCart->product_rows->reject(function ($product, $id) {
            return $product->id !== $id;
        });
        $sessionCart->product_rows = $filtered;

        Session::put('cart', $sessionCart);

        return redirect()->back();

    }

    public function calculate(Request $request)
    {
        $totalProducts = 0;
        $totalAmount = 0;
        $delivery_obj = Delivery::find($request->post('delivery_id'));
        $delivery = 0;
        $promoDiscount = 1;
        if ($delivery_obj) {
            $delivery = $delivery_obj->delivery_price;
        }
        $sessionCart = Session::get('cart');
        if($request->post('promocode')) {
            $promocode = Promocode::where('promocode_name', $request->post('promocode'))->first();
            if ($promocode) {
                $promoDiscount = $promocode->promocode_value/100;
                $sessionCart->promocode_id = $promocode->id;
                $sessionCart->promocode_value = $promocode->promocode_value;
            }
        }


        $listOfQuantities = $request->post('quantity');

        for ($i = 0; $i < count($request->post('product_ids')); $i++) {
            $sessionCart->product_rows[$i]['product_quantity'] = $listOfQuantities[$i];
            $sessionCart->product_rows[$i]['product_row_price'] = $listOfQuantities[$i] * $sessionCart->product_rows[$i]['product_price'];
            $totalProducts += $sessionCart->product_rows[$i]['product_row_price'];
        }
        $totalProducts = $totalProducts - $totalProducts * $promoDiscount;
        $totalAmount = $totalProducts + $delivery;
        $sessionCart->delivery_id = $request->post('delivery_id');
        $sessionCart->totalProducts = $totalProducts;
        $sessionCart->totalAmount = $totalAmount;

        Session::put('cart', $sessionCart);
        //dd(Session::get('cart'));
        return redirect('/cart');
    }

    public function reset()
    {
        Session::forget('cart');
    }
}
