<div class="container">
    <div class="divBestSellerContainer">
        <div class="d-flex flex-wrap justify-content-between">
                <div class="col-lg-3 col-md-3 col-sm-10 border rounded m-1 p-0 div-item-main-container" style="height: 300px; background-color: white;">
                    <div style="height: 60%;">
                        <div style="margin-right: auto; margin-left: auto; width: 50%; ">
                            <a class="url_no_decoration" href="{{route ('product.show', ['id' => 1] )}}">
                                <img width="100%" src="{{asset('/img/tmplogo.png')}}" alt="EmpTY">
                            </a>
                        </div>
                    </div>
                    <div class="product-item-title pt-0 pr-2 pb-0 pl-2 m-0 text-center">
                        <h3>
                            <a class="url_no_decoration" href="{{route ('product.show', ['id' => 1] )}}">
                                NAME 1
                            </a>
                        </h3>
                    </div>
                    <div class="product-item-price pt-0 pr-2 pb-0 pl-2 m-0 text-center">
                        <p>Price: <b>100</b>$</p>
                    </div>
                </div>


            <div class="col-lg-3 col-md-3 col-sm-10 border rounded m-1 p-0 div-item-main-container" style="height: 300px; background-color: white;">
                <div style="height: 60%;">
                    <div style="margin-right: auto; margin-left: auto; width: 50%; ">
                        <a class="url_no_decoration" href="{{route ('product.show', ['id' => 2] )}}">
                            <img width="100%" src="{{asset('/img/tmplogo.png')}}" alt="EmpTY">
                        </a>
                    </div>
                </div>
                <div class="product-item-title pt-0 pr-2 pb-0 pl-2 m-0 text-center">
                    <h3>
                        <a class="url_no_decoration" href="{{route ('product.show', ['id' => 2] )}}">
                            NAME 2
                        </a>
                    </h3>
                </div>
                <div class="product-item-price pt-0 pr-2 pb-0 pl-2 m-0 text-center">
                    <p>Price: <b>102</b>$</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-10 border rounded m-1 p-0 div-item-main-container" style="height: 300px; background-color: white;">
                <div style="height: 60%;">
                    <div style="margin-right: auto; margin-left: auto; width: 50%; ">
                        <a class="url_no_decoration" href="{{route ('product.show', ['id' => 3] )}}">
                            <img width="100%" src="{{asset('/img/tmplogo.png')}}" alt="EmpTY">
                        </a>
                    </div>
                </div>
                <div class="product-item-title pt-0 pr-2 pb-0 pl-2 m-0 text-center">
                    <h3>
                        <a class="url_no_decoration" href="{{route ('product.show', ['id' => 3] )}}">
                            NAME 3
                        </a>
                    </h3>
                </div>
                <div class="product-item-price pt-0 pr-2 pb-0 pl-2 m-0 text-center">
                    <p>Price: <b>103</b>$</p>
                </div>
            </div>


        </div>
        <div class="text-center mt-3">
            <span class="btn btn-primary">Show more...</span>
        </div>

    </div>

</div>
