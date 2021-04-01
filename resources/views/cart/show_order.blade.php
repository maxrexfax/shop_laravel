@extends('layouts.app')
@section('content')
    <div class="container bg-light">
        <span class="text-muted h4">{{__('text.details_of_order_n')}}</span> <span class="h3 text-bold">{{$order->uniq_id}}</span> <span class="text-muted small">{{__('text.please_save_this_number')}}!</span>
        <div class="row m-0">
            <div class="col-lg-4 p-2">
                <div class="bg-light order-details-font p-2">
                    <h3>{{__('text.order_information')}}:</h3>
                    <p>{{__('text.status_of_this_order')}}: {{$order->getStatus()->status_name}}</p>
                    <p>{{__('text.address')}}: {{$order->address}}</p>
                    <p>{{__('text.address_additional')}}: {{$order->address_additional}}</p>
                    <p>{{__('text.city')}}: {{$order->city}}</p>
                    <p>{{__('text.country')}}: {{$order->country}}</p>
                    <p>{{__('text.postcode')}}: {{$order->postcode}}</p>
                </div>
            </div>
            <div class="col-lg-4 p-2">
                <div class="bg-light order-details-font p-2">
                    <h3>{{__('text.client_information')}}:</h3>
                    <p>{{__('text.first_name')}}: {{$order->first_name}}</p>
                    <p>{{__('text.last_name')}}: {{$order->last_name}}</p>
                    <p>{{__('text.email')}}: {{$order->email}}</p>
                    <p>{{__('text.telephone')}}: {{$order->telephone}}</p>
                </div>
            </div>
            <div class="col-lg-4 p-2">
                <div class="bg-light order-details-font p-2">
                    <h3>{{__('text.options')}}:</h3>
                    <p>{{__('text.delivery_name')}}: {{$order->getDeliveryName()}}</p>
                    <p>{{__('text.delivery_price')}}: {{$order->getDeliveryPrice()}}$</p>
                    <p>{{__('text.discount')}}: {{$order->getDiscount()}}%</p>
                    <p>{{__('text.payment_method')}}:{{$order->getPaymentMethodName()}}</p>
                    <p>@if(!empty($paymentArray)) {{$paymentArray['paymentDescription']}} {{$paymentArray['paymentDetails']}} @endif</p>
                    <p>{{__('text.order_created_at')}}: {{$order->created_at}}</p>
                    <p>{{__('text.order_updated_at')}}: {{$order->updated_at}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 order-details-font">
                <h3>{{__('text.products_in_order')}}:</h3>
                <div class="overflow-auto w-100">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{__('actions.product_name')}}</th>
                            <th>{{__('text.product_price')}}</th>
                            <th>{{__('text.quantity')}}</th>
                            <th>{{__('text.product_summary')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->products as $product)
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
                    <p>{{__('text.total_order_price')}}: <b>{{$totalCost}}$</b>.</p>
                </div>
            </div>
        </div>
    </div>
    <section class="place-holder"></section>
    <section class="place-holder"></section>
    <section class="place-holder"></section>
@endsection
