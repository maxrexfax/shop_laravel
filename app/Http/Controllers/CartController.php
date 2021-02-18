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
        if (!session()->has('cart')) {
            $this->cart = new Cart();
        }

        Session::put('cart', $this->cart);
    }

    public function cart()
    {
        CartService::recalculateCart();
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
    }

    public function editOneRow(Request $request)
    {
        $new_row_price = (new CartService())->editOneRow($request->post('product_id'), $request->post('quantity'));

        $cart = Session::get('cart');

        return response()->json([
            'new_row_price' => (new Cart())->calculatePrice($new_row_price),
            'totalProducts' => (new Cart())->calculatePrice($cart->totalProducts),
            'totalAmount' => (new Cart())->calculatePrice($cart->totalAmount),
            'currency_symbol' => (new Cart())->getCurrencySymbol()
        ]);
    }

    public function calculate(Request $request)
    {
        (new CartService())->calculate($request);

        return redirect('/cart');
    }

    public function changeDelivery(Request $request)
    {
        (new CartService())->changeDelivery($request->post('delivery_id'));
        $cart = Session::get('cart');
        return response()->json([
            'totalAmount' => (new Cart())->calculatePrice($cart->totalAmount),
            'currency_symbol' => (new Cart())->getCurrencySymbol()
        ]);
    }

    public function addpromo(Request $request)
    {
        (new CartService())->setPromo($request->post('promo_text'));
    }

    public function data()
    {
        $cart = Session::get('cart');
        return response()->json([
            'totalProducts' => (new Cart())->calculatePrice($cart->totalProducts),
            'totalAmount' => (new Cart())->calculatePrice($cart->totalAmount),
            'currency_symbol' => (new Cart())->getCurrencySymbol()
        ]);
    }

    public function cartProductQuantity()
    {
        $cart = Session::get('cart');
        if (count($cart->product_rows)>0) {
            return count($cart->product_rows);
        }
        return 0;
    }

}
