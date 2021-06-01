<?php

namespace App\Http\Controllers;

use App\Category;
use App\CreditCard;
use App\Delivery;
use App\Discount;
use App\Http\Requests\EditOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Order;
use App\OrderProduct;
use App\PaymentMethod;
use App\PaypalPayment;
use App\Promocode;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\DeliveryRepositoryInterface;
use App\Repository\OrderProductRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use App\Repository\OrderStatusRepositoryInterface;
use App\Repository\PaymentMethodRepositoryInterface;
use App\Repository\PromocodeRepositoryInterface;
use App\Services\OrderStoreService;
use App\OrderStatus;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $categoryRepository;
    protected $deliveryRepository;
    protected $paymethodRepository;
    protected $promocodeRepository;
    protected $orderStatusRepository;
    protected $orderProductRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        CategoryRepositoryInterface $categoryRepository,
        DeliveryRepositoryInterface $deliveryRepository,
        PaymentMethodRepositoryInterface $paymethodRepository,
        PromocodeRepositoryInterface $promocodeRepository,
        OrderStatusRepositoryInterface $orderStatusRepository,
        OrderProductRepositoryInterface $orderProductRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->categoryRepository = $categoryRepository;
        $this->deliveryRepository = $deliveryRepository;
        $this->paymethodRepository = $paymethodRepository;
        $this->promocodeRepository = $promocodeRepository;
        $this->orderStatusRepository = $orderStatusRepository;
        $this->orderProductRepository = $orderProductRepository;
    }

    public function create()
    {
        return view('admin.partials.orders._order_create', [
            'statuses' => $this->orderStatusRepository->all(),
            'categories' => $this->categoryRepository->all(),
            'deliveries' => $this->deliveryRepository->all(),
            'paymentMethods' => $this->paymethodRepository->all(),
            'promocodes' => $this->promocodeRepository->all(),
        ]);
    }

    public function edit(EditOrderRequest $request)//сделать реквест проверку входящих данных в едиты
    {
        $order = $this->orderRepository->findById($request->get('id'));

        return view('admin.partials.orders._order_create', [
            'order' => $order,
            'paymentArray' => $order->getOrderPaymentDetails(),
            'statuses' => $this->orderStatusRepository->all(),
            'categories' => $this->categoryRepository->all(),
            'deliveries' => $this->deliveryRepository->all(),
            'paymentMethods' => $this->paymethodRepository->all(),
            'promocodes' => $this->promocodeRepository->all(),
        ]);
    }

    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderRepository->store($request);

        return redirect()->route('cart.show.order', [
            'uniqId' => $order->uniq_id,
        ]);
    }

    public function update(StoreOrderRequest $request)
    {
        $this->orderRepository->store($request);

        return redirect('admin/orders/list');
    }

    public function show($id)
    {
        $order = $this->orderRepository->findById($id);
        $productPriceWithDiscount = 0;
        $totalProductsPrice = 0;
        if ($order) {
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
                'paymentArray' => $order->getOrderPaymentDetails(),
            ]);
        }

        return redirect('admin/orders/list');
    }

    public function destroy(EditOrderRequest $request)
    {
        $this->orderProductRepository->destroyByForeignKeyOrderId($request->get('id'));
        $this->orderRepository->destroy($request->get('id'));

        return redirect('admin/orders/list');
    }


}
