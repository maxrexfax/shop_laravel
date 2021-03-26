@extends('admin.index')
@section('admin.content')
    <div class="card bg-white p-1">
        <div class="card-header text-center">
            <span class="h3">Details of order N {{$order->id}}</span>
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
        <form method="POST" action="{{ route('order.store', ['id' => $order->id]) }}" id="adminEditOrderForm">
            @csrf
        <div class="row m-0">
            <div class="col-lg-4 col-md-6 col-sm-12 p-2">
                <div class="bg-light order-details-font p-2">
                    <h3>Order information:</h3>
                    <div class="d-flex">
                        <p class="w-50">Status of this order:</p>
                        <select name="statuses_id" class="w-50">
                            @foreach($statuses as $status)
                                <option value="{{$status->id}}"
                                    @if($status->id === $order->getStatus()->id)
                                    selected
                                    @endif
                                >{{$status->status_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">Address: </span><input class="w-50" value="@if(!empty($order)){{$order->address}}@endif" name="address">
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">Address (additional): </span><input class="w-50" value="@if(!empty($order)){{$order->address_additional}}@endif" name="address_additional">
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">City: </span><input class="w-50" value="@if(!empty($order)){{$order->city}}@endif" name="city">
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">Country: </span>
                        <select class="w-50" name="country">
                            <option value="@if(!empty($order)){{$order->country}}@endif" selected>@if(!empty($order)){{$order->country}}@endif</option>
                            @include('cart.partials._countries_list')
                        </select>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">Postcode: </span><input class="w-50" value="@if(!empty($order)){{$order->postcode}}@endif" name="postcode">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 p-2">
                <div class="bg-light order-details-font p-2">
                    <h3>Client information:</h3>
                    <div class="d-flex">
                        <span class="w-50">First name: </span><input class="w-50" value="@if(!empty($order)){{$order->first_name}}@endif" name="first_name">
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">Last name: </span><input class="w-50" value="@if(!empty($order)){{$order->last_name}}@endif" name="last_name">
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">Email: </span><input class="w-50" value="@if(!empty($order)){{$order->email}}@endif" name="email">
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">Telephone: </span><input class="w-50" value="@if(!empty($order)){{$order->telephone}}@endif" name="telephone">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 p-2">
                <div class="bg-light order-details-font p-2">
                    <h3>Options:</h3>
                    <div class="d-flex">
                        <p class="w-50">Delivery name:</p>
                        <select name="delivery_id" class="w-50">
                            <option value="0"
                                    @if(empty($order->getDelivery()))
                                    selected
                                    @endif
                            >{{__('text.not_set')}}</option>
                            @foreach($deliveries as $delivery)
                                <option value="{{$delivery->id}}"
                                        @if($delivery->id === $order->getDelivery()->id)
                                        selected
                                        @endif
                                >{{$delivery->delivery_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <p class="w-50">Payment method:</p>
                        <select name="payment_method_name" class="w-50">
                            <option value="0"
                                    @if(empty($order->payment_method_id))
                                    selected
                                    @endif
                            >{{__('text.not_set')}}</option>
                            @foreach($paymentMethods as $paymentMethod)
                                <option value="{{$paymentMethod->payment_method_name}}"
                                        @if($paymentMethod->payment_method_name === $order->payment_method_name)
                                        selected
                                        @endif
                                >{{$paymentMethod->payment_method_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <div class="">
                        <p class="">Order created at: {{$order->created_at}}</p>
                        <p class="">Last update at: {{$order->updated_at}}</p>
                    </div>
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
                        @foreach($order->products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->price}}$</td>
                                <td><input type="number" value="{{$product->orderProduct($order->id)->products_quantity}}"  name="quantity[]"></td>
                                <td>{{$product->orderProduct($order->id)->products_quantity * $product->price}}$</td>
                                <input type="hidden" value="{{$product->id}}"  name="products[]">

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            <div><input class="btn btn-secondary" type="submit" value="{{__('actions.save')}}"></div>
        </form>
    </div>
@endsection
