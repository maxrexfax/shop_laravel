<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Delivery;
use App\Product;
use App\Promocode;
use App\Services\CartService;
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

        Session::put('cart', $this->cart);
    }

    public function cart()
    {
        return view('cart.cart', [
            'activeStore' => Store::firstWhere('active', '=', Store::STORE_IS_ACTIVE),
            'cart' => Session::get('cart')
        ]);
    }

    public function addProductToCart($id)
    {
        (new CartService())->addToCart($id);

        return redirect()->back();
    }

    public function deleteProductFromCart($id)
    {
        (new CartService())->deleteFromCart($id);

        return redirect()->back();
    }

    public function calculate(Request $request)
    {
        (new CartService())->calculate($request);

        return redirect('/cart');
    }

}
