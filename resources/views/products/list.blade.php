@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Categories</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTopMenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTopMenu">
            <ul class="navbar-nav mr-auto">
                @foreach ($categoriesIer->sortBy('sort_number') as $cat)
                    <li class="nav-item active">{{ $cat->category_name }}</li>
                    <ul>
                        @foreach ($cat->childrenCategories as $childCategory)
                            @include('admin.child_category', ['child_category' => $childCategory])
                        @endforeach
                    </ul>
                @endforeach
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</div>
                    <div class="d-flex justify-content-between flex-wrap">
                            @foreach($products as $product)
                                <div class="p-2 border m-2">
                                    <div class="text-center">
                                        <a href="{{ route('product.show', ['id' => $product->id]) }}">
                                            @if($product->image)
                                            <img height="200px" src="{{ asset('img/logo' . $product->image) }}" alt="{{$product->product_name}}"/>
                                                @else
                                             <img height="200px" src="{{ asset('img/empty.png') }}" alt="No logo"/>
                                            @endif
                                        </a>
                                    </div>
                                        <br>
                                    <span>{{$product->id}}</span>
                                    <span><bold>{{$product->product_name}}</bold></span>
                                    <span>{{$product->price}}</span>
                                    <br>
                                    <span><i>{{$product->title}}</i></span>
                                    <span>{{$product->short_description}}</span>
                                </div>
                            @endforeach

                        </div>
                    <div class="mx-auto">
                        @if($products->links())
                        {{ $products->links() }}
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
