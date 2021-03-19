@if(isset($cart->productRows))
    @foreach($cart->productRows as $productId => $product)
        <div class="border-bottom">
            <div class="tr pt-1 d-flex justify-content-between align-items-center" id="tr-{{ $productId }} ">
                <div class="d-flex">
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
                    </div>
                    <div class="w-75 pl-2">
                        <div>
                            <p style="font-style: italic;">{{$product['productName']}}</p>
                        </div>
                        <div>
                            <div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="cursor-pointer minus-product"><i
                                                class="fas fa-minus-square"></i></span>
                                    <span class="cursor-pointer plus-product"><i
                                                class="fas fa-plus-square"></i></span>
                                    <input style="width: 50px;" type="number" min="0" max="999"
                                           class="input{{$productId}} ml-1 mr-1 text-center input-product-quantity-cart form-control"
                                           value="{{$product['productQuantity']}}">
                                    <div class="row-price-holder row-price-{{$productId}}">
                                        {{$cart->calculatePrice($product['productRowPrice'])}}{{$cart->getCurrencySymbol()}}
                                    </div>
                                    <a data-id="{{$productId}}" data-confirm="{{__('actions.really_delete?')}}"
                                       class="delete-from-cart"
                                       href="{{route('cart.delete', ['id' => $productId])}}"
                                       title="{{__('messages.remove_this_item_from_cart')}}">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>


            </div>
        </div>
    @endforeach
@endif
