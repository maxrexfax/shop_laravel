@extends('layouts.app')
@section('content')
    <div class="w-100 bg-white p-0">
        <section class="place-holder"></section>
        <div class="container shopping-cart-main">
            <form method="POST" action="{{ route('cart.calculate') }}">
            <div class="row">
                    @csrf
                <div class="offset-md-1 col-md-7 col-sm-12">
                    <h2 class="h4">{{__('messages.shopping_cart')}}</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2">{{__('messages.product_details')}}</th>
                                <th>{{__('messages.quantity')}}</th>
                                <th>{{__('messages.price')}}</th>
                                <th>{{__('messages.total')}}</th>
                            </tr>
                        </thead>
                        <tbody>


                        @if(isset($cart->product_rows))
                        @foreach($cart->product_rows as $product)
                            <tr>
                                <td>
                                    <div class="image-in-cart">
                                        <img class="w-100" src="{{asset('/img/logo/' . $product['product_logo'])}}">
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
                                    <span class="font-italic"><a href="{{route('cart.delete', ['id' => $product['product_id']])}}" title="{{__('messages.remove_this_item_from_cart')}}">{{__('messages.remove')}}</a></span>
                                </td>
                                <td>
                                   {{$cart->calculatePrice($product['product_price'])}}{{$cart->getCurrencySymbol()}}
                                </td>
                                <td>
                                    {{$cart->calculatePrice($product['product_row_price'])}}{{$cart->getCurrencySymbol()}}
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3 col-sm-12 pt-3">
                    <div class="bg-light p-2">
                        <p class="font-weight-bold">{{__('messages.order_summary')}}</p>
                        <hr>
                        <div class="font-weight-bold w-100">{{__('messages.items')}}:
                            <span class="float-right">
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
                        <div class="font-weight-bold w-100">{{__('messages.total_cost')}} <span class="float-right">
                                @if(isset($cart->totalAmount))
                                    {{$cart->calculatePrice($cart->totalAmount)}}{{$cart->getCurrencySymbol()}}
                                @endif
                            </span></div>
                        <div class="clearfix"></div>
                        <br>
                        <button type="submit" class="btn btn-dark btn-block">{{__('messages.checkout')}}</button>
                        <br>
                        <p>
                            @if($cart->promocode_id)
                                {{__('messages.activated_discount')}}:{{$cart->promocode_value}}%
                            @endif
                        </p>
                        <br>
                        <p>{{__('messages.promotional_code')}} <span class="float-right show-input-btn" id="btnToAddPromoCode">+</span></p>
                        <div class="clearfix"></div>
                        <div class="text-center promocode-usage">
                            <input type="text" id="promoCodeInput" class="form-control" name="promocode">
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
