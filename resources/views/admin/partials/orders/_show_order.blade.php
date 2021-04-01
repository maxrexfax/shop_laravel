@extends('admin.index')
@section('admin.content')
    <div class="card bg-white p-1">
        <div class="card-header text-center">
            <span class="h3">{{__('text.details_of_order_n')}} {{$order->id}}</span>
            <a class="url_in_accordion ml-2 float-left" href="{{route('admin.orders.list')}}">
                <span class="btn btn-secondary" title="{{ __('text.back_to_orders_list') }}"><i class="fas fa-fast-backward"></i> {{ __('text.back_to_orders_list') }}</span>
            </a>
            @if(!empty($order))
                <a class="url_in_accordion ml-2 float-right" href="{{route('order.destroy', ['id' => $order->id])}}">
                    <span class="addButton" title="{{ __('actions.delete') }}"><i class="fas fa-trash"></i></span>
                </a>
                <a class="url_in_accordion ml-2 float-right" href="{{route('order.create', ['id' => $order->id])}}">
                    <span class="addButton" title="{{ __('actions.edit') }}"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <a class="url_in_accordion ml-2 float-right" href="{{route('order.create')}}">
                    <span class="addButton" title="{{ __('actions.create') }}"><i class="fas fa-plus-circle"></i></span>
                </a>
            @endif
        </div>
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
                    <p>{{__('text.uniq_id')}}: {{$order->uniq_id}}</p>
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
@endsection
