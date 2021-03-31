@extends('admin.index')
@section('admin.content')
    <div class="card bg-white p-1">
        <div class="card-header text-center">
            <span class="h3">Details of order N {{$order->id}}</span>
            <a class="url_in_accordion ml-2 float-left" href="{{route('admin.orders.list')}}">
                <span class="btn btn-secondary"><i class="fas fa-fast-backward"></i> {{ __('text.back_to_orders_list') }}</span>
            </a>
            <a class="url_in_accordion ml-2 float-right" href="{{route('order.destroy', ['id' => $order->id])}}">
                <span class="addButton" title="{{ __('actions.delete') }}"><i class="fas fa-trash"></i></span>
            </a>
            <a class="url_in_accordion ml-2 float-right" href="{{route('order.create', ['id' => $order->id])}}">
                <span class="addButton" title="{{ __('actions.edit') }}"><i class="fas fa-pencil-alt"></i></span>
            </a>
            <a class="url_in_accordion ml-2 float-right" href="{{route('order.create')}}">
                <span class="addButton" title="{{ __('actions.create') }}"><i class="fas fa-plus-circle"></i></span>
            </a>
        </div>

        <div class="row m-0">
            <div class="col-lg-4 p-2">
                <div class="bg-light order-details-font p-2">
                    <h3>Order information:</h3>
                    <p>Status of this order: {{$order->getStatus()->status_name}}</p>
                    <p>Address: {{$order->address}}</p>
                    <p>Address (additional): {{$order->address_additional}}</p>
                    <p>City: {{$order->city}}</p>
                    <p>Country: {{$order->country}}</p>
                    <p>Postcode: {{$order->postcode}}</p>
                </div>
            </div>
            <div class="col-lg-4 p-2">
                <div class="bg-light order-details-font p-2">
                    <h3>Client information:</h3>
                    <p>First name: {{$order->first_name}}</p>
                    <p>Last name: {{$order->last_name}}</p>
                    <p>Email: {{$order->email}}</p>
                    <p>Telephone: {{$order->telephone}}</p>
                </div>
            </div>
            <div class="col-lg-4 p-2">
                <div class="bg-light order-details-font p-2">
                    <h3>Options:</h3>
                    <p>Delivery name: {{$order->getDeliveryName()}}</p>
                    <p>Delivery cost: {{$order->getDeliveryPrice()}}$</p>
                    <p>Discount: {{$order->getDiscount()}}%</p>
                    <p>{{__('text.payment_method')}}:{{$order->getPaymentMethodName()}}</p>
                    <p>@if(!empty($paymentArray)) {{$paymentArray['paymentDescription']}} {{$paymentArray['paymentDetails']}} @endif</p>
                    <p>Order created at: {{$order->created_at}}</p>
                    <p>Order updated at: {{$order->updated_at}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 order-details-font">
                <h3>Products in this order:</h3>
                <div class="overflow-auto w-100">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product name</th>
                            <th>Product price</th>
                            <th>Quantity</th>
                            <th>Product summary</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->price}}$</td>
                                <td>{{$product->orderProduct($order->id)->products_quantity}}</td>
                                <td>{{$product->orderProduct($order->id)->products_quantity * $product->price}}$</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center w-100">
                    <p>Total price for this order: <b>{{$totalCost}}$</b>.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
