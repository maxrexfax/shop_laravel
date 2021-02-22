@extends('layouts.app')
@section('content')
    <div class="w-100 bg-white p-0">
        <section class="place-holder"></section>
        <div class="shopping-cart-main">
            <form method="POST" action="{{ route('cart.calculate') }}">
            <div class="row">
                    @csrf
                <div class="offset-md-1 col-md-7 col-sm-12">
                    <div class="text-center"><h2 class="h4">{{__('messages.shopping_cart')}}</h2></div>
                    <div class="d-none d-md-block overflow-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">{{__('messages.product_details')}}</th>
                                    <th>{{__('messages.quantity')}}</th>
                                    <th>{{__('messages.price')}}</th>
                                    <th>{{__('messages.total')}}</th>
                                    <th>{{__('messages.delete')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($cart->product_rows))
                            @foreach($cart->product_rows as $product)
                                <tr class="tr">
                                    <td>
                                        <div class="image-in-cart">
                                            <a href="{{route('product.show', ['id' => $product['product_id']])}}" target="_blank">
                                                <img class="w-100" src="{{asset('/img/logo/' . $product['product_logo'])}}">
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <h3>{{$product['product_name']}}</h3>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="hidden" value="{{$product['product_id']}}" name="product_ids[]">
                                        <input type="hidden" value="{{$product['product_price']}}" name="product_prices[]">
                                        <input type="number" min="0" max="999" id="{{$product['product_id']}}" name="quantity[]" class="text-center pl-3 input-product-quantity-cart form-control" value="{{$product['product_quantity']}}">
                                    </td>
                                    <td>
                                       {{$cart->calculatePrice($product['product_price'])}}{{$cart->getCurrencySymbol()}}
                                    </td>
                                    <td class="row-price-holder">
                                        {{$cart->calculatePrice($product['product_row_price'])}}{{$cart->getCurrencySymbol()}}
                                    </td>
                                    <td class="text-center">
                                        <span class="font-italic">
                                            <a data-id="{{$product['product_id']}}" data-confirm="{{__('actions.really_delete?')}}" class="delete-from-cart" href="{{route('cart.delete', ['id' => $product['product_id']])}}" title="{{__('messages.remove_this_item_from_cart')}}">
                                                <i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-md-none d-lg-none">
                        @if(isset($cart->product_rows))
                            @foreach($cart->product_rows as $product)
                                <div class="tr">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h3>{{$product['product_name']}}</h3>
                                        </div>
                                        <div>
                                        <span>
                                            <a data-id="{{$product['product_id']}}" data-confirm="{{__('actions.really_delete?')}}" class="delete-from-cart" href="{{route('cart.delete', ['id' => $product['product_id']])}}" title="{{__('messages.remove_this_item_from_cart')}}">
                                                <i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline">{{__('messages.price')}}: </div>
                                        <div class="d-inline">
                                            {{$cart->calculatePrice($product['product_price'])}}{{$cart->getCurrencySymbol()}}
                                        </div>
                                        <div class="d-inline">{{__('messages.quantity')}}: </div>
                                        <div class="d-inline col-xs-2">
                                            <input type="hidden" value="{{$product['product_id']}}" name="product_ids[]">
                                            <input type="hidden" value="{{$product['product_price']}}" name="product_prices[]">
                                            <input type="number" min="0" max="999" id="{{$product['product_id']}}" name="quantity[]" class="text-center input-product-quantity-cart form-control" value="{{$product['product_quantity']}}">
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="row-price-holder">
                                            {{__('messages.total_one_product')}}: {{$cart->calculatePrice($product['product_row_price'])}}{{$cart->getCurrencySymbol()}}
                                        </div>
                                    </div>

                                </div>
                                <hr>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 pt-3">
                    <div class="bg-light p-2">
                        <p class="font-weight-bold">{{__('messages.order_summary')}}</p>
                        <hr>
                        <div class="font-weight-bold w-100">{{__('messages.items')}}:
                            <span class="float-right" id="spanWithTotalProductsPrice">
                                @if(isset($cart->totalProducts))
                                    {{$cart->calculatePrice($cart->totalProducts)}}{{$cart->getCurrencySymbol()}}
                                @endif
                            </span>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <p>{{__('messages.shipping')}}</p>
                        <select class="form-control font-weight-bold" name="delivery_id" id="selectTypeOfDeliveryInCart">
                            <option value="0">{{__('messages.no_delivery')}}</option>
                            @foreach($activeStore->deliveries as $delivery)
                                <option value="{{$delivery->id}}"
                                    @if($cart->delivery_id == $delivery->id)
                                    selected
                                    @endif
                                    >{{$delivery->delivery_name}} - {{$cart->calculatePrice($delivery->delivery_price)}}{{$cart->getCurrencySymbol()}} </option>
                            @endforeach
                        </select>
                        <br>
                        <hr>
                        <br>
                        <div class="font-weight-bold w-100">{{__('messages.total_cost')}} <span class="float-right" id="spanWithTotalPrice">
                                @if(isset($cart->totalAmount))
                                    {{$cart->calculatePrice($cart->totalAmount)}}{{$cart->getCurrencySymbol()}}
                                @endif
                            </span></div>
                        <div class="clearfix"></div>
                        <br>
                        <span id="btnCheckout" data-info="{{__('messages.total_cost')}}" class="btn btn-dark btn-block">{{__('messages.checkout')}}</span>
                        <br>
                        <p>

                                {{__('messages.activated_discount')}}:
                            @if($cart->promocode_value)
                                {{$cart->promocode_value}}%
                            @endif
                        </p>
                        <br>
                        <p>{{__('messages.promotional_code')}} <span class="float-right show-input-btn" id="btnToAddPromoCode">+</span></p>
                        <div class="clearfix"></div>
                        <div class="text-center promocode-usage">
                            <div class="w-75">
                                <input type="text" id="promoCodeInput" class="form-control" name="promocode">
                            </div>
                            <span id="btnUsePromocode" class="btn btn-secondary d-inline">Use</span>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
<section class="place-holder"></section>
<section class="place-holder"></section>
<section class="place-holder"></section>
@endsection
