@extends('layouts.app')
@section('content')
    <div class="w-100 bg-white p-0">
        <section class="place-holder"></section>
        <div class="shopping-cart-main">
            <div class="row">
                <div class="offset-md-1 col-md-7 col-sm-12 overflow-auto">
                    <div class="text-center">
                        <h2 class="h4 mb-3">{{__('messages.shopping_cart')}}</h2>
                    </div>
                    <form method="POST" action="{{ route('cart.calculate') }}">
                        @csrf
                        <div class="table-container">
                            <div class="d-flex justify-content-between align-items-center border-bottom">
                                <div class="w-25 h5">{{__('messages.product_details')}}</div>
                                <div class="text-left h5">{{__('messages.quantity')}}</div>
                                <div class="text-right h5">{{__('messages.price')}}</div>
                                <div class="text-right h5">{{__('messages.total')}}</div>
                                <div class="text-right h5">{{__('messages.delete')}}</div>
                            </div>
                            @if(isset($cart->productRows))
                                @foreach($cart->productRows as $productId => $product)
                                    <div class="border-bottom">
                                        <div class="tr pt-1 d-flex justify-content-between align-items-center" id="tr-{{ $productId }} ">
                                            <div class="w-25">
                                                <div>
                                                    <div class="image-in-cart d-none d-md-block">
                                                        <a href="{{route('product.show', ['id' => $productId])}}"
                                                           target="_blank">
                                                            @if(!empty($product['productLogo']))
                                                                <img class="w-100"
                                                                     src="{{asset('/img/logo/' . $product['productLogo'])}}">
                                                            @else
                                                                <img class="w-100"
                                                                     src="{{asset('/img/empty.png')}}">
                                                            @endif
                                                        </a>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div>
                                                        <h3>{{$product['productName']}}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                <span class="cursor-pointer minus-product"><i
                                                            class="fas fa-minus-square fa-2x"></i></span>
                                                    <input type="number" min="0" max="999"
                                                           class="input{{$productId}} ml-1 mr-1 text-center input-product-quantity-cart form-control"
                                                           value="{{$product['productQuantity']}}">
                                                    <span class="cursor-pointer plus-product"><i
                                                                class="fas fa-plus-square fa-2x"></i></span>
                                                </div>
                                            </div>
                                            <div class="">
                                                {{$cart->calculatePrice($product['productPrice'])}}{{$cart->getCurrencySymbol()}}
                                            </div>
                                            <div class="row-price-holder row-price-{{$productId}}">
                                                {{$cart->calculatePrice($product['productRowPrice'])}}{{$cart->getCurrencySymbol()}}
                                            </div>
                                            <div class="text-center" style="width: 10%">
                                            <span class="font-italic">
                                                <a data-id="{{$productId}}" data-confirm="{{__('actions.really_delete?')}}"
                                                   class="delete-from-cart"
                                                   href="{{route('cart.delete', ['id' => $productId])}}"
                                                   title="{{__('messages.remove_this_item_from_cart')}}">
                                                    <i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                                </a>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </form>
                    @if(empty($cart->productRows))
                        <div class="text-center text-secondary">
                            <p>{{__('text.cart_is_empty')}}, <a href="{{route('category.list')}}">{{__('text.lets_go_shopping')}}</a>!</p>
                        </div>
                    @else
                        <a href="{{route('cart.reset')}}" class="btn btn-secondary btn-sm float-right mt-1">{{__('actions.reset_cart')}}</a>
                    @endif
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
                        <select class="form-control font-weight-bold" name="delivery_id"
                                id="selectTypeOfDeliveryInCart">
                            <option value="0">{{__('messages.no_delivery')}}</option>
                            @foreach($activeStore->deliveries as $delivery)
                                <option value="{{$delivery->id}}"
                                        @if($cart->deliveryId == $delivery->id)
                                        selected
                                        @endif
                                >{{$delivery->delivery_name}}
                                    - {{$cart->calculatePrice($delivery->delivery_price)}}{{$cart->getCurrencySymbol()}} </option>
                            @endforeach
                        </select>
                        <br>
                        <hr>
                        <br>
                        <div class="font-weight-bold w-100">{{__('messages.total_cost')}} <span class="float-right"
                                                                                                id="spanWithTotalPrice">
                                @if(isset($cart->totalAmount))
                                    {{$cart->calculatePrice($cart->totalAmount)}}{{$cart->getCurrencySymbol()}}
                                @endif
                            </span></div>
                        <div class="clearfix"></div>
                        <br>
                        <span id="btnCheckout" data-info="{{__('messages.total_cost')}}"
                              class="btn btn-dark btn-block">{{__('messages.checkout')}}</span>
                        <br>
                        <p>
                            @if($cart->promocodeValue)
                                {{__('messages.activated_discount')}}: {{$cart->promocodeValue}}%
                            @endif
                        </p>
                        <br>
                        <p>{{__('messages.promotional_code')}} <span class="float-right show-input-btn"
                                                                     id="btnToAddPromoCode">+</span></p>
                        <div class="clearfix"></div>
                        <form method="POST" action="{{ route('cart.calculate') }}">
                            @csrf
                            <div class="text-center promocode-usage">

                                <input type="text" id="promoCodeInput" class="form-control float-left promo-input-name"
                                       name="promocode">

                                <button type="submit" value="promoadd" id="btnUsePromocode"
                                        class="btn btn-secondary float-right promo-button-use">{{__('actions.use')}}Use
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                @include('cart.partials._other_products')
            </div>
            <div class="row">
                @include('cart.partials._visited_products')
            </div>
        </div>
    </div>
    <section class="place-holder"></section>
    <section class="place-holder"></section>
    <section class="place-holder"></section>
@endsection
