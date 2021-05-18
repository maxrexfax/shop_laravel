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

    /**
     * Store Order function in controller
     * @param null $id
     * @param StoreOrderRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($id = null, StoreOrderRequest $request)
    {
        $paying = null;
        $order = Order::find($id);

        if (!$order) {
            $order = new Order();
        }

        $this->orderRepository->store($order, $request);
        //$order = (new OrderStoreService())->store($order, $request);

        if ($request->post('customer')) {
            return redirect()->route('cart.show.order', [
                'uniq_id' => $order->uniq_id,
            ]);
        }
        return redirect('admin/orders/list');
    }

    public function show($id)
    {
        $order = Order::find($id);
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
        $order = Order::find($id);

        if ($order) {
            OrderProduct::where('order_id', '=', $id)->delete();
            $order->delete();
        }

        return redirect('admin/orders/list');
    }

    /**
     * Create new or edit existing Order
     * @param null $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create($id = null)
    {
        if (!empty($id)) {
            $order = Order::find($id);
            $paymentDetails = null;
            if ($order) {
                return view('admin.partials.orders._order_create', [
                    'order' => $order,
                    'statuses' => OrderStatus::all(),
                    'categories' => Category::all(),
                    'deliveries' => Delivery::all(),
                    'paymentMethods' => PaymentMethod::all(),
                    'promocodes' => Promocode::all(),
                    'paymentArray' => $this->getOrderPaymentDetails($order),
                ]);
            }

            return redirect('admin/orders/list');
        }

        return view('admin.partials.orders._order_create', [
            'statuses' => OrderStatus::all(),
            'categories' => Category::all(),
            'deliveries' => Delivery::all(),
            'paymentMethods' => PaymentMethod::all(),
            'promocodes' => Promocode::all(),
        ]);
    }
}
