@extends('layouts.app')
@section('content')
    <div class="container p-0">
        <div class="row p-0">
                <div class="card col-md-12 p-0 background_as_nav">
                    @include('menu._category_menu')
                </div>
            <div class="d-flex flex-wrap justify-content-between">
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-3 col-sm-10 border rounded m-1 p-0 div-item-main-container" style="height: 300px; background-color: white;">
                        <div style="height: 60%;">
                            <div style="margin-right: auto; margin-left: auto; width: 50%; ">
                                <a class="url_no_decoration" href="{{route ('product.show', ['id' => $product->id] )}}">
                                    <img width="100%" src="{{asset('/img/logo/' . $product->logo_image)}}" alt="{{$product->product_name}}">
                                </a>
                            </div>
                        </div>
                        <div class="product-item-title pt-0 pr-2 pb-0 pl-2 m-0">
                            <h3>
                                <a class="url_no_decoration" href="{{route ('product.show', ['id' => $product->id] )}}">
                                    {{$product->product_name}}
                                </a>
                            </h3>
                        </div>
                        <div class="product-item-price pt-0 pr-2 pb-0 pl-2 m-0">
                            <p>Price: <b>{{$product->price}}</b>$</p>
                        </div>
                        <div class="hide pt-0 pr-2 pb-0 pl-2 m-0" style="height: 50%;">
                            <div style="height: 70%; overflow-y: auto;" class="product-item-description p-2">
                                <p style="overflow: hidden;">{{$product->short_description}}</p>
                            </div>
                            <div class="product-item-button">
                                <button id="{{$product->id}}" class="btn btn-secondary w-100 m-0 btn_add_to_cart" style="position: relative; ">Add to cart</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
