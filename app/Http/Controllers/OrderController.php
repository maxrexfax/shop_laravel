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
use App\Services\OrderStoreService;
use App\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function store($id = null, StoreOrderRequest $request)
    {
        $paying = null;
        $order = Order::find($id);

        if (!$order) {
            $order = new Order();
        }

        $order = (new OrderStoreService())->store($order, $request);

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

    public function getOrderPaymentDetails($order)
    {
        $paymentArray = [];
        if ($order->payment_method_code === PaymentMethod::PAYMENT_METHOD_CREDIT) {
            $paymentArray['paymentDetails'] = (CreditCard::find($order->payment_method_id))->credit_card_number;
            $paymentArray['paymentDescription'] = trans('text.credit_card_number');
        } else if ($order->payment_method_code === PaymentMethod::PAYMENT_METHOD_PAYPAL) {
                $paymentArray['paymentDetails'] = (PaypalPayment::find($order->payment_method_id)) ? (PaypalPayment::find($order->payment_method_id))->paypal_email : '';
                $paymentArray['paymentDescription'] = trans('text.paypal_method_details');
        } else if ($order->payment_method_code === PaymentMethod::PAYMENT_METHOD_CASH) {
            $paymentArray['paymentDetails'] = '';
            $paymentArray['paymentDescription'] = trans('text.cash_method_details');
        }
        return $paymentArray;
    }

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
