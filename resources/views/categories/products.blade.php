@extends('layouts.app')
@section('content')
    <div class="container p-0">
        <div class="row p-0">
                <div class="card col-md-12 p-0">
                    @include('menu._category_menu')
                </div>
            <div class="d-flex flex-wrap justify-content-space">
                @foreach($products as $product)
                    <div class="col-lg-2 col-md-3 col-sm-12 border rounded m-2">
                        <a class="url_no_decoration" href="{{route ('product.show', ['id' => $product->id] )}}">
                            <img width="100%" src="{{asset('/img/logo/' . $product->logo_image)}}">
                        </a>
                    <h2>
                        <a class="url_no_decoration" href="{{route ('product.show', ['id' => $product->id] )}}">
                            {{$product->product_name}}
                        </a>
                    </h2>
                        <p style="overflow: hidden;">{{$product->short_description}}</p>
                        <p>Price: <b>{{$product->price}}</b>$</p>
                        <button class="btn btn-secondary w-100 m-0">Add to cart</button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
