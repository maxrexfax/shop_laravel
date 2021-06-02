@if(!empty($visitedProducts))
<div class="text-center w-100"><h3>{{__('text.visited_products')}}</h3></div>
<div class="col-md-1"></div>
@endif
<div class="parent-for-scroll col-md-11">
    @if(!empty($visitedProducts))
        <i class="fa fa-chevron-left scroll-product-control scroll-left-btn" data-scroll="visited-products-container" aria-hidden="true"></i>
        <i class="fa fa-chevron-right scroll-product-control scroll-right-btn" data-scroll="visited-products-container" aria-hidden="true"></i>
    @endif
    <div class="d-flex justify-content-between align-items-center div-products-category-container visited-products-container">
        @if(!empty($visitedProducts))
            @foreach($visitedProducts as $visitedProduct)
                <div class="col-lg-2" title="{{$visitedProduct->product_name}}">
                    <a class="url-no-decoration" href="{{route('product.show',  ['id' => $visitedProduct->id])}}">
                        <div class="cart-image-additional">
                            <span class="helper">&nbsp;</span>
                            @if(!empty($visitedProduct->logo_image))
                                <img class="additional-image-in-cart"
                                     src="{{asset('/img/logo/' . $visitedProduct->logo_image)}}">
                            @else
                                <img class="additional-image-in-cart"
                                     src="{{asset('/img/empty.png')}}">
                            @endif
                        </div>
                        <div class="text-center">
                            <p>{{$visitedProduct->product_name}}</p>
                        </div>
                    </a>
                    <div class="product-item-button">
                        <span data-message="{{__('messages.added_to_cart')}}" data-id="{{$visitedProduct->id}}" class="btn btn-secondary w-100 m-0 btn-adder-to-cart">{{__('actions.add_to_cart')}}</span>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
