@extends('admin.index')
@section('admin.content')
    <div class="card bg-white p-1">
        <div class="card-header text-center">
            @if(isset($order))
                {{__('text.edit_order_n')}} {{$order->id}}
            @else
                {{__('text.create_order')}}
            @endif
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
        <div class="errors text-center bg-danger">
            @if($errors)
                @foreach($errors->all() as $error)
                    {{$error}}
                @endforeach
            @endif
        </div>
        <form method="POST" action="{{ route('order.store', ['id' => isset($order) ? $order->id : 0]) }}" id="adminEditOrderForm">
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
                                    @if(!empty($order) && $status->id === $order->getStatus()->id)
                                    selected
                                    @endif
                                >{{$status->status_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">Address: </span><input class="w-50 form-control @error('address') is-invalid @enderror" value="@if(!empty($order)){{$order->address}}@endif" name="address" required>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">Address (additional): </span><input class="w-50 form-control @error('address_additional') is-invalid @enderror" value="@if(!empty($order)){{$order->address_additional}}@endif" name="address_additional">
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">City: </span><input class="w-50 form-control @error('city') is-invalid @enderror" value="@if(!empty($order)){{$order->city}}@endif" name="city" required>
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
                        <span class="w-50">Postcode: </span><input class="w-50 form-control @error('postcode') is-invalid @enderror" value="@if(!empty($order)){{$order->postcode}}@endif" name="postcode" required>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 p-2">
                <div class="bg-light order-details-font p-2">
                    <h3>Client information:</h3>
                    <div class="d-flex">
                        <span class="w-50">First name: </span><input class="w-50 form-control @error('first_name') is-invalid @enderror" value="@if(!empty($order)){{$order->first_name}}@endif" name="first_name" required>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">Last name: </span><input class="w-50 form-control @error('last_name') is-invalid @enderror" value="@if(!empty($order)){{$order->last_name}}@endif" name="last_name" required>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">Email: </span><input class="w-50 form-control @error('email') is-invalid @enderror" value="@if(!empty($order)){{$order->email}}@endif" name="email" required>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">Telephone: </span><input class="w-50 form-control @error('telephone') is-invalid @enderror" value="@if(!empty($order)){{$order->telephone}}@endif" name="telephone" required>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 p-2">
                <div class="bg-light order-details-font p-2">
                    <h3>Options:</h3>
                    <div class="d-flex">
                        <p class="w-50">Delivery name:</p>
                        <select name="delivery_id" class="w-50">
                            <option value=""
                                    @if(!empty($order) && empty($order->getDelivery()))
                                    selected
                                    @endif
                            >{{__('text.not_set')}}</option>
                            @foreach($deliveries as $delivery)
                                <option value="{{$delivery->id}}"
                                        @if(!empty($order) && $delivery->id === $order->getDeliveryId())
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
                            <option value=""
                                    @if(empty($order->payment_method_id))
                                    selected
                                    @endif
                            >{{__('text.not_set')}}</option>
                            @foreach($paymentMethods as $paymentMethod)
                                <option value="{{$paymentMethod->payment_method_name}}"
                                        @if(!empty($order) && $paymentMethod->payment_method_name === $order->payment_method_name)
                                        selected
                                        @endif
                                >{{$paymentMethod->payment_method_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <p class="w-50">Promocode:</p>
                        <select name="promocode_id" class="w-50">
                            <option value=""
                                    @if(empty($order->payment_method_id))
                                    selected
                                    @endif
                            >{{__('text.not_set')}}</option>
                            @foreach($promocodes as $promocode)
                                <option value="{{$promocode->id}}"
                                        @if(!empty($order) && $promocode->id === $order->promocode_id)
                                        selected
                                        @endif
                                >{{$promocode->promocode_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <div class="div-dates-of-create-update">
                        <p class="">Order created at: {{isset($order) ? $order->created_at : ''}}</p>
                        <p class="">Last update at: {{isset($order) ? $order->updated_at : ''}}</p>
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
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody class="tbody-for-order-products">
                        @if(count($order->products) > 0)
                        @foreach($order->products as $product)
                            <tr class="tr" id="{{$product->id}}">
                                <td>{{$product->id}}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->price}}$</td>
                                <td><input type="number" value="{{$product->orderProduct($order->id)->products_quantity}}"  name="quantity[]"></td>
                                <td>{{$product->orderProduct($order->id)->products_quantity * $product->price}}$</td>
                                <td>
                                    <span title="{{__('text.delete')}}" class="float-right btn-delete-product-from-order cursor-pointer">
                                        <span><i class="fa fa-trash fa-lg" aria-hidden="true"></i></span>
                                    </span>
                                </td>
                                <input type="hidden" value="{{$product->id}}"  name="products[]">
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="container">
                        <div class="text-center h4">Add new products to this order</div>
                            <div class="col-md-6 col-sm-12 div-for-choose-products">
                                <label for="selectCategoryOfProduct" class="col-form-label text-md-right mr-2">{{ __('actions.category_name') }}</label>
                                <select id="selectCategoryOfProduct" name="selectCategoryOfProduct" class="mr-2 form-control">
                                    <option value="0">Select category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                                <div id="divForProductsFromCategory">
                                    <label for="selectForProductsFromCategory" class="col-form-label text-md-right mr-2">{{ __('actions.product_name') }}</label>
                                    <select id="selectForProductsFromCategory" name="selectForProductsFromCategory" class="mr-2 form-control">
                                        <option value="">{{__('text.empty')}}</option>
                                    </select>
                                </div>
                            <span id="btnAddProductToCart" class="btn btn-secondary btn-block mr-2" data-confirm="{{__('text.already_in_use')}}">{{__('actions.add_this_product')}}</span>
                            </div>
                    </div>
                </div>
            </div>
        </div>
            <div><input class="btn btn-secondary" type="submit" value="{{__('actions.save')}}"></div>
        </form>
    </div>
@endsection
