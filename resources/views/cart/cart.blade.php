@extends('layouts.app')
@section('content')
    <div class="w-100 bg-white p-0">
        <section class="place-holder"></section>
        <div class="container shopping-cart-main">
            <form method="POST" action="{{ route('cart.calculate') }}">
            <div class="row">
                    @csrf
                <div class="offset-md-1 col-md-7 col-sm-12">
                    <h2 class="h4">Shopping cart</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product details</th>
                                <th></th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>


                        @if(isset($cart->product_rows))
                        @foreach($cart->product_rows as $product)
                            <tr>
                                <td class="col-md-3">
                                    <div>
                                        <img class="w-100" src="{{asset('/img/logo/' . $product['product_logo'])}}">
                                    </div>
                                </td>
                                <td class="col-md-4">
                                    <h3>{{$product['product_name']}}</h3>
                                    <div class="product-description">
                                        <p>short_description</p>
                                    </div>
                                </td>
                                <td>
                                    <input type="hidden" value="{{$product['product_id']}}" name="product_ids[]">
                                    <input type="hidden" value="{{$product['product_price']}}" name="product_prices[]">
                                    <input type="number" min="0" max="999" id="{{$product['product_id']}}" name="quantity[]" class="text-center pl-3 input-product-quantity-cart form-control" value="{{$product['product_quantity']}}">
                                </td>
                                <td>
                                    {{$product['product_price']}}
                                </td>
                                <td>
                                    {{$product['product_row_price']}}
                                </td>
                                <td><a href="{{route('cart.delete', ['id' => $product['product_id']])}}">X</a></td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3 col-sm-12 pt-3">
                    <div class="bg-light p-2">
                        <p class="font-weight-bold">Order summary</p>
                        <hr>
                        <div class="font-weight-bold w-100">ITEMS:
                            <span class="float-right">
                                @if(isset($cart->totalProducts))
                                    {{$cart->totalProducts}}
                                @endif
                            </span>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <p>SHIPPING</p>
                        <select class="form-control font-weight-bold" name="delivery_id" id="selectTypeOfDeliveryInCart">
                            <option value="0"> </option>
                            @foreach($activeStore->deliveries as $delivery)
                                <option value="{{$delivery->id}}"
                                    @if($cart->delivery_id == $delivery->id)
                                    selected
                                    @endif
                                    >{{$delivery->delivery_name}} - {{$delivery->delivery_price}}</option>
                            @endforeach
                        </select>
                        <br>
                        <hr>
                        <br>
                        <div class="font-weight-bold w-100">TOTAL COST <span class="float-right">
                                @if(isset($cart->totalAmount))
                                    {{$cart->totalAmount}}
                                @endif
                            </span></div>
                        <div class="clearfix"></div>
                        <br>
                        <button type="submit" class="btn btn-dark btn-block">CHECKOUT</button>
                        <br>
                        <p>
                            @if($cart->promocode_id)
                                Activated discount:{{$cart->promocode_value}}%
                            @endif
                        </p>
                        <br>
                        <p>PROMOTIONAL CODE <span class="float-right show-input-btn" id="btnToAddPromoCode">+</span></p>
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
