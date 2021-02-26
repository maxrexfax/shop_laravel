<div class="container mb-5">
    <div class="divBestSellerContainer">
        <div class="d-flex flex-wrap justify-content-between mb-5 products">
            <div class="col-lg-4 col-md-4 col-xs-12 p-3">
                <div class="item">
                    <div class="sub-container">
                        <a class="url-no-decoration" href="{{route('product.show',  ['id' => 1])}}"><div class="image" style="background-image:url({{asset('/img/tmplogo.png')}}); background-color: transparent;"></div></a>
                        <a class="url-no-decoration" href="{{route('product.show',  ['id' => 1])}}"><h1 class="text-center">Product name 1</h1></a>
                        <h2 class="text-dark text-center">{{__('text.price')}}: <b>123</b></h2>
                        <div class="informations">
                            <div class="product-item-description p-2">
                                <p class="overflow-hidden">Short description</p>
                            </div>
                            <div class="product-item-button">
                                <span data-id="1" class="btn btn-secondary w-100 m-0 btn-adder-to-cart">{{__('actions.add_to_cart')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12 p-3">
                <div class="item">
                    <div class="sub-container">
                        <a class="url-no-decoration" href="{{route('product.show',  ['id' => 1])}}"><div class="image" style="background-image:url({{asset('/img/tmplogo.png')}}); background-color: transparent;"></div></a>
                        <a class="url-no-decoration" href="{{route('product.show',  ['id' => 1])}}"><h1 class="text-center">Product name 1</h1></a>
                        <h2 class="text-dark text-center">{{__('text.price')}}: <b>123</b></h2>
                        <div class="informations">
                            <div class="product-item-description p-2">
                                <p class="overflow-hidden">Short description</p>
                            </div>
                            <div class="product-item-button">
                                <span data-id="1" class="btn btn-secondary w-100 m-0 btn-adder-to-cart">{{__('actions.add_to_cart')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12 p-3">
                <div class="item">
                    <div class="sub-container">
                        <a class="url-no-decoration" href="{{route('product.show',  ['id' => 1])}}"><div class="image" style="background-image:url({{asset('/img/tmplogo.png')}}); background-color: transparent;"></div></a>
                        <a class="url-no-decoration" href="{{route('product.show',  ['id' => 1])}}"><h1 class="text-center">Product name 1</h1></a>
                        <h2 class="text-dark text-center">{{__('text.price')}}: <b>123</b></h2>
                        <div class="informations">
                            <div class="product-item-description p-2">
                                <p class="overflow-hidden">Short description</p>
                            </div>
                            <div class="product-item-button">
                                <span data-id="1" class="btn btn-secondary w-100 m-0 btn-adder-to-cart">{{__('actions.add_to_cart')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <button class="btn btn-primary">{{__('Show more...')}}</button>
        </div>
    </div>
</div>
