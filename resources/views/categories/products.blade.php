@extends('layouts.app')
@section('content')
<div class="w-100 bg-white">
    <div class="container">
        <div class="row">
            <div class="breadcrumbs-container container w-100 my-breadcrumb-decoration"><a href="{{route('main.page')}}">{{__('actions.home')}}</a><span class="gray-category-name-breadcrumb"> / {{$currentCategory->category_name}}</span></div>
            <div class="col-12 text-center"><h2>{{$currentCategory->category_name}}</h2></div>
            <div class="col-xs-12 col-md-3 sidebar">
                <nav class="sidebar-menu">
                    <div class="nav-title accordion_header bg-light border-bottom-green-2px text-dark my-roboto-font-family font-weight-bold p-4">
                        {{__('actions.categories')}}
                        <i class="d-sm-block d-md-none d-lg-none fa fa-bars pull-right float-right"></i>
                    </div>
                    <div class="accordion_content_categories pl-4">
                        <ul class="list-unstyled">
                            @foreach($categoriesAll as $category)
                                <li class="mb-2 all-category-item
                                    @if($currentCategory->id === $category->id)
                                    category-chosen
                                    @else
                                    @endif
                                "><a href="{{route('product.category',  ['id' => $category->id])}}">{{$category->category_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-xs-12 col-md-9">
                <div class="w-100 border-bottom-green-2px bg-light mb-2 p-2 my-roboto-font-family d-flex flex-wrap justify-content-between align-items-center">
                    <div class="form-inline pt-2">
                        <p class="d-sm-none d-md-none d-lg-block mt-2">{{__('actions.products')}}: {{count($products)}}</p>
                    </div>
                    <div class="form-inline p-0 m-0">
                        <div class="d-sm-none d-md-none d-lg-block">
                        {{__('actions.show_by')}}
                            <select class="form-control ml-2 mr-2" id="paginateQuantity" data-paginateQuantity="{{$paginateQuantity}}">
                                <option value="6" @if($paginateQuantity==6) selected @else @endif>6 {{__('actions.per_page')}}</option>
                                <option value="12" @if($paginateQuantity==12) selected @else @endif>12 {{__('actions.per_page')}}</option>
                                <option value="40" @if($paginateQuantity==40) selected @else @endif>40 {{__('actions.per_page')}}</option>
                            </select>
                        </div>
                        {{__('actions.sort_by')}}
                        <select class="form-control ml-2" id="sortBySelect">
                            <option value="" @if($sortType=='')selected @endif></option>
                            <option value="asc" @if($sortType=='asc')selected @else @endif>{{__('actions.price_asc')}}</option>
                            <option value="desc" @if($sortType=='desc')selected @else @endif>{{__('actions.price_desc')}}</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-start">
                    @foreach($products as $product)
                        <div class="col-lg-4 col-md-4 col-xs-12 p-3">
                            <div class="p-0 rounded div-item-main-container">
                                <div class="div-product-logo-image-container">
                                    <div class="div-product-logo-image-container-intro">
                                        <a class="url_no_decoration" href="{{route ('product.show', ['id' => $product->id] )}}">
                                            <img width="100%" src="{{asset('/img/logo/' . $product->logo_image)}}" alt="{{$product->product_name}}">
                                        </a>
                                    </div>
                                </div>
                                <div class="product-item-title text-center pt-0 pr-2 pb-0 pl-2 m-0">
                                    <h2 class="h6 w-100 overflow-hidden">
                                        <a class="url_no_decoration" href="{{route ('product.show', ['id' => $product->id] )}}">
                                            {{$product->product_name}}
                                        </a>
                                    </h2>
                                </div>
                                <div class="product-item-price text-center pt-0 pr-2 pb-0 pl-2 m-0">
                                    <p id="productPrice">{{__('text.price')}}: <b>{{$product->currentPrice()}}</b></p>
                                </div>
                                <div class="hide pt-0 pr-2 pb-0 pl-2 m-0 rounded-bottom h-50">
                                    <div class="product-item-description p-2">
                                        <p class="overflow-hidden">{{$product->short_description}}</p>
                                    </div>
                                    <div class="product-item-button">
                                        <button id="{{$product->id}}" class="btn btn-secondary w-100 m-0 btn_add_to_cart">{{__('actions.add_to_cart')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                    <hr>
                </div>
                <div class="col-sm-2 my-class-text-center">
                    @if(!empty($products))
                        {{ $products->appends(['paginateQuantity' => $paginateQuantity, 'sortType'=> $sortType])->render()}}
                    @endif
                </div>
            </div>
            <div class=""></div>
        </div>
    </div>


</div>
    <section class="place-holder"></section>
@endsection
