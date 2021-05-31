<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Delivery;
use App\Order;
use App\PaymentMethod;
use App\Product;
use App\Promocode;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\DeliveryRepositoryInterface;
use App\Repository\Eloquent\UserRepository;
use App\Repository\OrderRepositoryInterface;
use App\Repository\PaymentMethodRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use App\Repository\StoreRepositoryInterface;
use App\Repository\UserRepositoryInterface;
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
    protected $storeRepository;
    protected $productRepository;
    protected $orderRepository;
    protected $userRepository;
    protected $paymentMethodRepository;

    public function __construct(StoreRepositoryInterface $storeRepository,
                                ProductRepositoryInterface $productRepository,
                                CategoryRepositoryInterface $categoryRepository,
                                DeliveryRepositoryInterface $deliveryRepository,
                                OrderRepositoryInterface $orderRepository,
                                PaymentMethodRepositoryInterface $paymentMethodRepository,
                                UserRepositoryInterface $userRepository
    )
    {
        if (!session()->has('cart')) {
            Session::put('cart', new Cart());
        }
        $this->cart = new Cart();
        $this->storeRepository = $storeRepository;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->categoryRepository = $categoryRepository;
        $this->deliveryRepository = $deliveryRepository;
        $this->cartService = new CartService($this->productRepository, $this->categoryRepository, $this->deliveryRepository);
    }

    public function cart()
    {
        $this->cartService->recalculateCart();

        return view('cart.cart', [
            'activeStore' => $this->storeRepository->getActiveStore(),
            'cart' => Session::get('cart') ? Session::get('cart') : new Cart(),
            'additionalProducts' => $this->cartService->getAdditionalProducts(),
            'visitedProducts' => Session::get('visitedProducts') ? $this->productRepository->getArrayOfProductsByIds(Session::get('visitedProducts')) : '',
        ]);
    }

    public function addProductToCart($id)
    {

        $this->cartService->addToCart($this->productRepository->findById($id));

        return redirect()->back();
    }

    public function deleteProductFromCart($id)
    {
        $this->cartService->deleteFromCart($id);
        $this->cartService->recalculateCart();
        $cart = Session::get('cart');

        return response()->json([
            'productRowsCount' => count($cart->productRows),
            'totalProducts' => $this->cart->calculatePrice($cart->totalProducts),
            'totalAmount' => $this->cart->calculatePrice($cart->totalAmount),
            'currencySymbol' => $this->cart->getCurrencySymbol()
        ]);
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
        $this->cartService->calculate($request, $this->promocodeRepository->getPromocodeByName($request->post('promocode')));

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
        $activeStore = $this->storeRepository->getActiveStore();
        return view('cart.checkout', [
            'activeStore' => $activeStore,
            'cart' => Session::get('cart') ? Session::get('cart') : new Cart(),
            'additionalProducts' => $this->cartService->getAdditionalProducts(),
            'visitedProducts' => Session::get('visitedProducts') ? $this->productRepository->getArrayOfProductsByIds(Session::get('visitedProducts')) : '',
            'loginUser' => Session::get('loginUserId') ? $this->userRepository->findById(Session::get('loginUserId')) : '',
            'deliveries' => $activeStore->deliveries,
            'paymentMethods' => $this->paymentMethodRepository->all(),
        ]);
    }

    public function showOrder($uniqId)
    {
        $order = $this->orderRepository->getOrderByUniqId($uniqId);
        if ($order) {
            $paymentArray = $order->getOrderPaymentDetails($order);
            $totalProductsPrice = 0;
            $productPriceWithDiscount = 0;
            foreach ($order->products as $product) {
                $totalProductsPrice += $product->orderProduct($order->id)->products_quantity * $product->price;
            }

            if ($order->getDiscount() > 0) {
                $productPriceWithDiscount = $totalProductsPrice - ($totalProductsPrice * $order->getDiscount()) / 100;
            } else {
                $productPriceWithDiscount = $totalProductsPrice;
            }

            return view('cart.show_order', [
                'order' => $order,
                'paymentArray' => $paymentArray,
                'totalCost' => $order->getDeliveryPrice() + $productPriceWithDiscount,
            ]);
        }

        return redirect('/');
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
