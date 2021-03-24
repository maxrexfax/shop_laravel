@extends('layouts.app')
@section('content')
    <div class="w-100 bg-white p-0">
        <div class="breadcrumbs-container container w-100 breadcrumb-decoration"><a href="{{route('main.page')}}">{{__('actions.home')}}</a><span class="gray-category-name-breadcrumb"> / {{__('messages.checkout')}}</span></div>
        <section class="place-holder"></section>
        <div class="shopping-cart-checkout">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-10 col-xs-12 pr-2 border-right-dashed">
                        <div class="div-data-user-info">
                            <div>
                                <p><span class="number-in-checkout">1.</span> BILLING ADDRESS</p>
                            </div>
                            <div class="tabs">
                                <input type="radio" name="tab-btn" id="tab-btn-1" value="" checked>
                                <label for="tab-btn-1" class="font-size-mini">Without login</label>
                                <input type="radio" name="tab-btn" id="tab-btn-2" value="">
                                <label for="tab-btn-2" class="font-size-mini">Login</label>

                                <div id="content-1">
                                    @guest
                                        @include('cart.partials._login_partial')
                                    @else
                                        Logined as user: @if(!empty($loginUser)){{$loginUser->login}} @else @endif
                                    @endguest
                                </div>

                                <div id="content-2">
                                    @include('cart.partials._form_elements')
                                </div>

                            </div>
                            @include('cart.partials._form_elements2')

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-10 col-xs-12 pl-2 pr-2 border-right-dashed">
                        <div class="div-shipping-payment-methods">
                            <p><span class="number-in-checkout">2.</span> {{__('text.shipping_method')}}</p>
                            <p>{{__('text.please_choose_the_shipping_options')}}:</p>
                                @include('cart.partials._form_shipping')
                            <p><span class="number-in-checkout">3.</span> {{__('text.payment_method')}}<span style="color: red">*</span></p>
                                @include('cart.partials._form_paymeth')
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-10 col-xs-12 pl-2 pr-2">
                        <div>
                            <p><span class="number-in-checkout">4.</span> {{__('text.review_your_order')}}</p>
                                @include('cart.partials._form_all_products_checkout')
                            <br>
                            <div class="font-weight-bold w-100 border-bottom border-top bg-light d-flex">
                               <span class="w-75 d-inline-block text-center">{{__('messages.total_cost')}}</span> <span class="w-25 d-inline-block" id="spanWithTotalPrice">
                                @if(isset($cart->totalAmount))
                                    {{$cart->calculatePrice($cart->totalAmount)}}{{$cart->getCurrencySymbol()}}
                                @endif
                            </span>
                            </div>
                            <br>
                            <p><input style="vertical-align: middle;" type="checkbox" form="checkoutForm" name="isWantNewsLetters">
                                <span class="font-size-mini">{{__('text.subscribe_for_newsletters')}}</span></p>
                            <input type="submit" class="btn btn-special-color btn-block text-white font-weight-bold" value="{{__('actions.place_order')}}" form="checkoutForm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="place-holder"></section>
    <section class="place-holder"></section>
    <section class="place-holder"></section>
@endsection
