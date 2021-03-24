@if(isset($cart->productRows))
    @foreach($cart->productRows as $productId => $product)
        <div class="border-bottom tr" id="tr-{{ $productId }}">
            <div class="pt-1 d-flex justify-content-between align-items-center">
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
                                    <span>
                                    <input style="width: 40px; display: inline;" type="number" min="0" max="999"
                                           class="input{{$productId}} text-center input-product-quantity-cart form-control"
                                           value="{{$product['productQuantity']}}">
                                        <span class="cursor-pointer minus-product color-custom-gray"><i class="fas fa-minus-circle"></i></span>
                                        <span class="cursor-pointer plus-product color-custom-gray"><i class="fas fa-plus-circle"></i></span>
                                    </span>
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
