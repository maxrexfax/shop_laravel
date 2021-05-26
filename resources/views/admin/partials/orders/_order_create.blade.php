@extends('admin.index')
@section('admin.content')
    <div class="card bg-white p-1">
        <div class="card-header text-center">
            @if(isset($order))
                {{__('text.edit_order_n')}} {{$order->id}}
            @else
                {{__('text.create_order')}}
            @endif
            <a class="url_in_accordion ml-2 float-left" href="{{route('admin.orders.list')}}">
                <span class="btn btn-secondary" title="{{ __('text.back_to_orders_list') }}"><i class="fas fa-fast-backward"></i> {{ __('text.back_to_orders_list') }}</span>
            </a>
            @if(!empty($order))
                <a class="url_in_accordion ml-2 float-right" href="{{route('order.destroy', ['id' => $order->id])}}">
                    <span class="addButton" title="{{ __('actions.delete') }}"><i class="fas fa-trash"></i></span>
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
        <form method="POST" action="@if(!isset($order)){{ route('order.store')}} @else {{ route('order.update', ['id' => $order->id])}} @endif" id="checkoutForm">
            @csrf
            @if(isset($order))<input type="hidden" name="orderId" value="{{$order->id}}">@endif
        <div class="row m-0">
            <div class="col-lg-4 col-md-6 col-sm-12 p-2">
                <div class="bg-light order-details-font p-2">
                    <h3>{{__('text.order_information')}}:</h3>
                    <div class="d-flex">
                        <p class="w-50">{{__('text.order_status')}}:</p>
                        <select name="order_statuses_id" class="w-50">
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
                        <span class="w-50">{{__('text.address')}}: </span><input class="w-50 form-control @error('address') is-invalid @enderror" value="@if(!empty($order)){{$order->address}}@endif" name="address" required>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">{{__('text.address_additional')}}: </span><input class="w-50 form-control @error('address_additional') is-invalid @enderror" value="@if(!empty($order)){{$order->address_additional}}@endif" name="address_additional">
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">{{__('text.city')}}: </span><input class="w-50 form-control @error('city') is-invalid @enderror" value="@if(!empty($order)){{$order->city}}@endif" name="city" required>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">{{__('text.country')}}: </span>
                        <select class="w-50" name="country">
                            <option value="@if(!empty($order)){{$order->country}}@endif" selected>@if(!empty($order)){{$order->country}}@endif</option>
                            @include('cart.partials._countries_list')
                        </select>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">{{__('text.postcode')}}: </span><input class="w-50 form-control @error('postcode') is-invalid @enderror" value="@if(!empty($order)){{$order->postcode}}@endif" name="postcode" required>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">{{__('text.uniq_id')}}: </span><span class="w-50">@if(!empty($order)){{$order->uniq_id}}@endif</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 p-2">
                <div class="bg-light order-details-font p-2">
                    <h3>{{__('text.client_information')}}:</h3>
                    <div class="d-flex">
                        <span class="w-50">{{__('text.first_name')}}: </span><input class="w-50 form-control @error('first_name') is-invalid @enderror" value="@if(!empty($order)){{$order->first_name}}@endif" name="first_name" required>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">{{__('text.last_name')}}: </span><input class="w-50 form-control @error('last_name') is-invalid @enderror" value="@if(!empty($order)){{$order->last_name}}@endif" name="last_name" required>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">{{__('text.email')}}: </span><input class="w-50 form-control @error('email') is-invalid @enderror" value="@if(!empty($order)){{$order->email}}@endif" name="email" required>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="w-50">{{__('text.telephone')}}: </span><input class="w-50 form-control @error('telephone') is-invalid @enderror" value="@if(!empty($order)){{$order->telephone}}@endif" name="telephone" required>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 p-2">
                <div class="bg-light order-details-font p-2">
                    <h3>{{__('text.options')}}:</h3>
                    <div class="d-flex align-items-center">
                        <p class="w-50">{{__('text.delivery_name')}}:</p>
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
                    <div class="d-flex align-items-center"><p class="w-50">{{__('text.payment_method')}}</p><p class="w-50">@if(!empty($order)) {{$order->getPaymentMethodName()}} @endif </p></div>
                    <div class="details-for-current-payment-method d-flex mt-2 align-items-center">@if(!empty($paymentArray)) <p class="w-50">{{$paymentArray['paymentDescription']}}:</p> <p class="w-50">{{$paymentArray['paymentDetails']}}</p> @endif</div>

                    <div class="d-flex align-items-center">
                        <p class="w-50">{{__('text.change_payment_method')}}:</p>
                        <select id="selectPaymentMethodsInOrder" name="payment_method_code" class="w-50 payment-methods-select">
                            <option value="defaultValue" selected>{{__('text.not_set')}}</option>
                            @foreach($paymentMethods as $paymentMethod)
                                <option value="{{$paymentMethod->payment_method_code}}">{{$paymentMethod->payment_method_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="details-for-payment-method"></div>
                    <hr>
                    <div class="d-flex align-items-center">
                        <p class="w-50">{{__('text.promocode')}}:</p>
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
                        <p class="">{{__('text.order_created_at')}}: {{isset($order) ? $order->created_at : ''}}</p>
                        <p class="">{{__('text.last_update_at')}}: {{isset($order) ? $order->updated_at : ''}}</p>
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
                            <th class="text-right">{{__('actions.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody class="tbody-for-order-products">
                        @if(!empty($order) && count($order->products) > 0)
                        @foreach($order->products as $product)
                            <tr class="tr" id="{{$product->id}}">
                                <td>{{$product->id}}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->price}}$</td>
                                <td><input type="number" class="input-quantity" value="{{$product->orderProduct($order->id)->products_quantity}}"  name="quantity[]"></td>
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
                        <div class="text-center h4">{{__('text.add_new_product_to_order')}}</div>
                            <div class="col-md-6 col-sm-12 div-for-choose-products">
                                <label for="selectCategoryOfProduct" class="col-form-label text-md-right mr-2">{{ __('actions.category_name') }}</label>
                                <select id="selectCategoryOfProduct" name="selectCategoryOfProduct" class="mr-2 form-control">
                                    <option value="0">{{__('text.select_category')}}</option>
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
