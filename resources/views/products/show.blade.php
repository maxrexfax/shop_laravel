@extends('layouts.app')
@section('content')
<div class="bg-white w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 div-img-modal-show p-0">
                        <div class="p-2">
                            <div class="border text-center p-2">
                                    @if($product->logo_image)
                                        <img class="img-to-show-modal" height="300px" src="{{ asset('/img/logo/' . $product->logo_image)}}" alt="{{$product->product_name}}"/>
                                    @else
                                        <img height="200px" src="{{ asset('/img/empty.png')}}" alt="{{__('text.no_current_logo_image!')}}"/>
                                    @endif
                            </div>
                            <div class="d-flex" style="overflow: auto; width: 100%">
                                @foreach($product->images as $img)
                                    <div class="border m-2">
                                        <img class="img-to-show-modal" height="100px" src="{{ asset('/img/images/' . $img->image_name) }}" alt="{{$img->image_name}}"/>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 p-2">
                        <div class="border rounded h-100 p-2">
                            <h2 class="text-center">{{$product->product_name}}</h2>
                            <p>{{__('actions.price:')}}{{$product->price}}</p>
                            <br>
                            <p>{{__('actions.title:')}}<i>{{$product->title}}</i></p>
                            <p>{{__('actions.short_description')}}{{$product->short_description}}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 p-2">
                        <div class="border rounded p-2">
                            <h3>{{__('text.description:')}}</h3>
                            <p>{{$product->full_description}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="place-holder"></section>
    <section class="place-holder"></section>
    <div id="shadow">
        <span class="modal-control-elements step-back" title="{{__('text.previous')}}">&#9664;</span>
        <span class="modal-control-elements step-forward" title="{{__('text.next')}}">&#9654;</span>
    </div>
    <div id="modal-with-images">
        <p id="close-popup-symbol" class="float-right modal-control-elements" title="Close"><i class="fa fa-window-close" aria-hidden="true"></i></p><br>
        <span class="text-center"><img src="" alt="" /></span>
        <p id="images-gallery-info" class="float-right"></p>
    </div>
</div>
@endsection
