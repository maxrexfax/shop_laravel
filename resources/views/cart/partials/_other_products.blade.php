@if(!empty($cart->productRows))
<div class="text-center w-100"><h3>{{__('text.other_items_from_selected_categories')}}</h3></div>
<div class="col-md-1"></div>
@endif
<div class="parent-for-scroll col-md-11 mb-5">
    @if(!empty($cart->productRows))
    <i class="fa fa-chevron-left scroll-product-control scroll-left-btn" data-scroll="other-products-container" aria-hidden="true"></i>
    <i class="fa fa-chevron-right scroll-product-control scroll-right-btn" data-scroll="other-products-container" aria-hidden="true"></i>
    @endif
    <div class="d-flex justify-content-between align-items-center div-products-category-container other-products-container">
        @if(!empty($cart->productRows))
        @foreach($additionalProducts as $additionalProduct)
        <div class="col-lg-2" title="{{$additionalProduct->product_name}}">
            <a class="url-no-decoration" href="{{route('product.show',  ['id' => $additionalProduct->id])}}">
                <div class="cart-image-additional">
                    <span class="helper"></span>
                    @if(!empty($additionalProduct->logo_image))
                    <img class="additional-image-in-cart"
                         src="{{asset('/img/logo/' . $additionalProduct->logo_image)}}">
                    @else
                    <img class="additional-image-in-cart"
                         src="{{asset('/img/empty.png')}}">
                    @endif
                </div>
                <div class="text-center">
                    <p>{{$additionalProduct->product_name}}</p>
                </div>
            </a>
            <div class="product-item-button">
                <span data-message="{{__('messages.added_to_cart')}}" data-id="{{$additionalProduct->id}}" class="btn btn-secondary w-100 m-0 btn-adder-to-cart">{{__('actions.add_to_cart')}}</span>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
