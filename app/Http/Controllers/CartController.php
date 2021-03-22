<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Delivery;
use App\PaymentMethod;
use App\Product;
use App\Promocode;
use App\Services\CartService;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public $cart;
    public $cartService;

    public function __construct()
    {
        if (!session()->has('cart')) {
            Session::put('cart', new Cart());
        }
        $this->cart = new Cart();
        $this->cartService = new CartService();
    }

    public function cart()
    {
        $this->cartService->recalculateCart();

        return view('cart.cart', [
            'activeStore' => Store::firstWhere('active', '=', Store::STORE_IS_ACTIVE),
            'cart' => Session::get('cart'),
            'additionalProducts' => $this->cartService->getAdditionalProducts(),
            'arrayOfVisitedProducts' => Session::get('arrayOfVisitedProducts') ? Product::find(Session::get('arrayOfVisitedProducts')): '',
        ]);
    }

    public function addProductToCart($id)
    {
        $this->cartService->addToCart($id);

        return redirect()->back();
    }

    public function deleteProductFromCart($id)
    {
        $this->cartService->deleteFromCart($id);
    }

    public function edit(Request $request)
    {
        $new_row_price = $this->cartService->editOneRow($request->post('productId'), $request->post('productQuantity'));

        $cart = Session::get('cart');

        return response()->json([
            'newRowPrice' => $this->cart->calculatePrice($new_row_price),
            'totalProducts' => $this->cart->calculatePrice($cart->totalProducts),
            'totalAmount' => $this->cart->calculatePrice($cart->totalAmount),
            'currencySymbol' => $this->cart->getCurrencySymbol()
        ]);
    }

    public function calculate(Request $request)
    {
        $this->cartService->calculate($request);

        return redirect('/cart');
    }

    public function changeDelivery(Request $request)
    {
        $this->cartService->changeDelivery($request->post('delivery_id'));
        $cart = Session::get('cart');
        return response()->json([
            'totalAmount' => $this->cart->calculatePrice($cart->totalAmount),
            'currency_symbol' => $this->cart->getCurrencySymbol()
        ]);
    }

    public function data()
    {
        $cart = Session::get('cart');
        return response()->json([
            'totalProducts' => $this->cart->calculatePrice($cart->totalProducts),
            'totalAmount' => $this->cart->calculatePrice($cart->totalAmount),
            'currencySymbol' => $this->cart->getCurrencySymbol()
        ]);
    }

    public function cartProductQuantity()
    {
        $cart = Session::get('cart');
        if (!empty($cart->productRows)) {
            return count($cart->productRows);
        }

        return 0;
    }

    public function checkoutCart()
    {
        $activeStore = Store::firstWhere('active', '=', Store::STORE_IS_ACTIVE);
        return view('cart.checkout', [
            'activeStore' => $activeStore,
            'cart' => Session::get('cart'),
            'additionalProducts' => $this->cartService->getAdditionalProducts(),
            'arrayOfVisitedProducts' => Session::get('arrayOfVisitedProducts') ? Product::find(Session::get('arrayOfVisitedProducts')): '',
            'loginUser' => Session::get('loginUserId') ? User::find(Session::get('loginUserId')) : '',
            'deliveries' => $activeStore->deliveries,
            'paymentMethods' => PaymentMethod::all(),
        ]);
    }

    public function checkoutCheck(Request $request)
    {
        dd($request->post());
        return back();
    }

    public function getPaymentDetails($path)
    {
        return view("cart/paymethods/{$path}")->render();
    }

    public function reset()
    {
        Session::forget('cart');
        return redirect('/cart');
    }

}
