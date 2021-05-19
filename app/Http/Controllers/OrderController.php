<?php

namespace App\Http\Controllers;

use App\Category;
use App\CreditCard;
use App\Delivery;
use App\Discount;
use App\Http\Requests\StoreOrderRequest;
use App\Order;
use App\OrderProduct;
use App\PaymentMethod;
use App\PaypalPayment;
use App\Promocode;
use App\Repository\OrderRepositoryInterface;
use App\Services\OrderStoreService;
use App\OrderStatus;

class OrderController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }


    public function create()
    {
        return view('admin.partials.orders._order_create', [
            'statuses' => OrderStatus::all(),
            'categories' => Category::all(),
            'deliveries' => Delivery::all(),
            'paymentMethods' => PaymentMethod::all(),
            'promocodes' => Promocode::all(),
        ]);
    }

    public function edit($id = null)
    {
        if($id == null) {
            return redirect('admin/orders/list');
        }

        $order = $this->orderRepository->findById($id);

        if ($order) {
            return view('admin.partials.orders._order_create', [
                'order' => $order,
                'statuses' => OrderStatus::all(),
                'categories' => Category::all(),
                'deliveries' => Delivery::all(),
                'paymentMethods' => PaymentMethod::all(),
                'promocodes' => Promocode::all(),
                'paymentArray' => $order->getOrderPaymentDetails(),
            ]);
        }

        return redirect('admin/orders/list');
    }

    public function store(StoreOrderRequest $request)
    {
        $order = new Order();

        $this->orderRepository->store($request, $order);

        return redirect()->route('cart.show.order', [
            'uniq_id' => $order->uniq_id,
        ]);
    }

    public function update($id = null, StoreOrderRequest $request)
    {
        $order = $this->orderRepository->findById($id);

        if ($order) {
            $this->orderRepository->store($request, $order);
        }

        return redirect('admin/orders/list');
    }

    public function show($id)
    {
        $order = $this->orderRepository->findById($id);
        $productPriceWithDiscount = 0;
        if ($order) {
            $totalProductsPrice = 0;
            foreach ($order->products as $product) {
                $totalProductsPrice += $product->orderProduct($id)->products_quantity * $product->price;
            }

            if ($order->getDiscount() > 0) {
                $productPriceWithDiscount = $totalProductsPrice - ($totalProductsPrice * $order->getDiscount()) / 100;
            } else {
                $productPriceWithDiscount = $totalProductsPrice;
            }

            return view('admin.partials.orders._show_order', [
                'order' => $order,
                'products' =>$order->products,
                'orderProducts' => $order->orderProduct,
                'totalProductsPrice' => $totalProductsPrice,
                'productPriceWithDiscount' => $productPriceWithDiscount,
                'totalCost' => $order->getDeliveryPrice() + $productPriceWithDiscount,
                'paymentArray' => $this->getOrderPaymentDetails($order),
            ]);
        }

        return redirect('admin/orders/list');
    }

    public function destroy($id)
    {
        $order = $this->orderRepository->findById($id);

        if ($order) {
            OrderProduct::where('order_id', '=', $id)->delete();
            $this->orderRepository->destroy($id);
        }

        return redirect('admin/orders/list');
    }


}
