<?php

namespace App\Http\Controllers;

use App\Category;
use App\CreditCard;
use App\Delivery;
use App\Order;
use App\OrderProduct;
use App\PaymentMethod;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function store($id = null, Request $request)
    {
        //dd($request->post());
        $paying = null;
        $order = Order::find($id);

        if (!$order) {
            $order = new Order();
        }

        if ($request->post('payment_method_name') === PaymentMethod::PAYMENT_METHOD_CREDIT) {
            $paying = new CreditCard();
            $paying->card_type = $request->post('card_type');
            $paying->credit_card_number = $request->post('credit_card_number');
            $paying->expiration_year = $request->post('expiration_year');
            $paying->expiration_month = $request->post('expiration_month');
            $paying->card_verification_number = $request->post('card_verification_number');
            $paying->save();
        }

        $order->first_name = $request->post('first_name');
        $order->last_name = $request->post('last_name');
        $order->email = $request->post('email');
        $order->telephone = $request->post('telephone');
        $order->address = $request->post('address');
        $order->address_additional = $request->post('address_additional');
        $order->city = $request->post('city');
        $order->postcode = $request->post('postcode');
        $order->country = $request->post('country');
        $order->delivery_id = $request->post('delivery_id') ? $request->post('delivery_id') : null;
        $order->payment_method_name = $request->post('payment_method_name');
        $order->payment_method_id = 0;
        $order->statuses_id = $request->post('statuses_id');
        $order->save();

        OrderProduct::where('order_id', '=', $id)->delete();
        foreach ($request->post('products') as $key => $product) {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $request->post('products')[$key];
            $orderProduct->products_quantity = $request->post('quantity')[$key];
            $orderProduct->save();
        }

        return back();
    }

    public function show($id)
    {
        $order = Order::find($id);

        if ($order) {
            $totalProductsPrice = 0;
            foreach ($order->products as $product) {
                $totalProductsPrice += $product->orderProduct($id)->products_quantity * $product->price;
            }
            return view('admin.partials.orders._show_order', [
                'order' => $order,
                'products' =>$order->products,
                'orderProducts' => $order->orderProduct,
                'totalCost' => $order->getDeliveryPrice() + $totalProductsPrice,
            ]);
        }

        return redirect('admin/orders/list');
    }

    public function softDelete($id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->statuses_id = Order::ORDER_STATUS_DELETED;
            $order->save();
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

    public function create($id = null)
    {
        if (!empty($id)) {
            $order = Order::find($id);
            if ($order) {
                return view('admin.partials.orders._order_create', [
                    'order' => $order,
                    'statuses' => Status::all(),
                    'categories' => Category::all(),
                    'deliveries' => Delivery::all(),
                    'paymentMethods' => PaymentMethod::all(),
                ]);
            }

            return redirect('admin/orders/list');
        }

        return view('admin.partials.orders._order_create', [
            'statuses' => Status::all(),
            'categories' => Category::all(),
        ]);
    }
}
