<div class="container mb-5">
    <div class="divBestSellerContainer">
        <div class="d-flex flex-wrap justify-content-between mb-5">
                <div class="col-lg-3 col-md-3 col-sm-10 border rounded m-1 p-0 div-item-main-container">
                    <div style="height: 60%;">
                        <div style="margin-right: auto; margin-left: auto; width: 50%; ">
                            <a class="url-no-decoration" href="{{route ('product.show', ['id' => 1] )}}">
                                <img width="100%" src="{{asset('/img/tmplogo.png')}}" alt="EmpTY">
                            </a>
                        </div>
                    </div>
                    <div class="product-item-title pt-0 pr-2 pb-0 pl-2 m-0 text-center">
                        <h3>
                            <a class="url-no-decoration" href="{{route ('product.show', ['id' => 1] )}}">
                                {{__('NAME 1')}}
                            </a>
                        </h3>
                    </div>
                    <div class="product-item-price pt-0 pr-2 pb-0 pl-2 m-0 text-center">
                        <p class="font-weight-bold">{{__('Price:')}} 100$</p>
                    </div>
                </div>


            <div class="col-lg-3 col-md-3 col-sm-10 border rounded m-1 p-0 div-item-main-container">
                <div style="height: 60%;">
                    <div style="margin-right: auto; margin-left: auto; width: 50%; ">
                        <a class="url-no-decoration" href="{{route ('product.show', ['id' => 2] )}}">
                            <img width="100%" src="{{asset('/img/tmplogo.png')}}" alt="EmpTY">
                        </a>
                    </div>
                </div>
                <div class="product-item-title pt-0 pr-2 pb-0 pl-2 m-0 text-center">
                    <h3>
                        <a class="url-no-decoration" href="{{route ('product.show', ['id' => 2] )}}">
                            {{__('NAME 2')}}
                        </a>
                    </h3>
                </div>
                <div class="product-item-price pt-0 pr-2 pb-0 pl-2 m-0 text-center">
                    <p class="font-weight-bold">{{__('Price:')}} 102$</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-10 border rounded m-1 p-0 div-item-main-container">
                <div style="height: 60%;">
                    <div style="margin-right: auto; margin-left: auto; width: 50%; ">
                        <a class="url-no-decoration" href="{{route ('product.show', ['id' => 3] )}}">
                            <img width="100%" src="{{asset('/img/tmplogo.png')}}" alt="EmpTY">
                        </a>
                    </div>
                </div>
                <div class="product-item-title pt-0 pr-2 pb-0 pl-2 m-0 text-center">
                    <h3>
                        <a class="url-no-decoration" href="{{route ('product.show', ['id' => 3] )}}">
                            {{__('NAME 3')}}
                        </a>
                    </h3>
                </div>
                <div class="product-item-price pt-0 pr-2 pb-0 pl-2 m-0 text-center">
                    <p class="font-weight-bold">{{__('Price:')}} 103$</p>
                </div>
            </div>


        </div>
        <div class="text-center mt-5">
            <button class="btn btn-primary">{{__('Show more...')}}</button>
        </div>

    </div>

</div>
