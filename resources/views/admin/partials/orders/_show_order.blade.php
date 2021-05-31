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
                <a class="url_in_accordion ml-2 float-right" href="{{route('order.edit', ['id' => $order->id])}}">
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
                    <div class="d-flex mb-2">
                        <span class="w-50">{{__('text.status_of_this_order')}}: </span><span class="w-50 text-right">{{$order->getStatus()->status_name}}</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="w-50">{{__('text.address')}}: </span><span class="w-50 text-right">{{$order->address}}</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="w-50">{{__('text.address_additional')}}: </span><span class="w-50 text-right">{{$order->address_additional}}</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="w-50">{{__('text.city')}}: </span><span class="w-50 text-right">{{$order->city}}</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="w-50">{{__('text.country')}}: </span><span class="w-50 text-right">{{$order->country}}</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="w-50">{{__('text.postcode')}}: </span><span class="w-50 text-right">{{$order->postcode}}</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="w-50">{{__('text.uniq_id')}}: </span><span class="w-50 text-right">{{$order->uniq_id}}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 p-2">
                <div class="bg-light order-details-font p-2">
                    <h3>{{__('text.client_information')}}:</h3>
                    <div class="d-flex mb-2">
                        <span class="w-50">{{__('text.first_name')}}: </span><span class="w-50 text-right">{{$order->first_name}}</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="w-50">{{__('text.last_name')}}: </span><span class="w-50 text-right">{{$order->last_name}}</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="w-50">{{__('text.email')}}: </span><span class="w-50 text-right">{{$order->email}}</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="w-50">{{__('text.telephone')}}: </span><span class="w-50 text-right">{{$order->telephone}}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 p-2">
                <div class="bg-light order-details-font p-2">
                    <h3>{{__('text.options')}}:</h3>
                    <div class="d-flex mb-2">
                        <span class="w-50">{{__('text.delivery_name')}}: </span><span class="w-50 text-right">{{$order->getDeliveryName()}}</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="w-50">{{__('text.delivery_price')}}: </span><span class="w-50 text-right">{{$order->getDeliveryPrice()}}</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="w-50">{{__('text.discount')}}: </span><span class="w-50 text-right">{{$order->getDiscount()}}%</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="w-50">{{__('text.payment_method')}}: </span><span class="w-50 text-right">{{$order->getPaymentMethodName()}}</span>
                    </div>
                    @if(!empty($paymentArray))
                        <div class="d-flex mb-2">
                            <span class="w-50">{{$paymentArray['paymentDescription']}}: </span><span class="w-50 text-right">{{$paymentArray['paymentDetails']}}</span>
                        </div>
                    @endif
                    <div class="d-flex mb-2">
                        <span class="w-50">{{__('text.order_created_at')}}: </span><span class="w-50 text-right">{{$order->created_at}}</span>
                    </div>
                    <div class="d-flex mb-2">
                        <span class="w-50">{{__('text.order_updated_at')}}: </span><span class="w-50 text-right">{{$order->updated_at}}</span>
                    </div>
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
