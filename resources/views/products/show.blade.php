@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="border row">
                    <div class="col col-10 col-md-8 col-sm-12 div-img-modal-show">
                        <div class="m-2 ">
                            <div class="border text-center">
                                    @if($product->logo_image)
                                        <img class="img-to-show-modal" height="300px" src="/img/logo/{{$product->image}}" alt="{{$product->product_name}}"/>
                                    @else
                                        <img height="200px" src="/img/empty.png" alt="tmpalt"/>
                                    @endif
                            </div>
                            <div class="d-flex" style="overflow: auto; width: 100%">
                                @foreach($images as $img)
                                    @if($img->product_id==$product->id)
                                        <div class="border m-2">
                                            <img class="img-to-show-modal" height="100px" src="/img/images/{{$img->image_name}}" alt="tmpalt2"/>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col col-2 col-md-3 col-sm-12 mt-2">
                        <h2>{{$product->product_name}}</h2>
                        <p>{{__('Price:')}}{{$product->price}}</p>
                        <br>
                        <p>{{__('Title:')}}<i>{{$product->title}}</i></p>
                        <p>{{__('Short description:')}}{{$product->short_description}}</p>
                        <p>{{__('Full description:')}}{{$product->full_description}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="shadow">
        <span class="modal-control-elements step-back" title="Previous">&#9664;</span>
        <span class="modal-control-elements step-forward" title="Next">&#9654;</span>
    </div>
    <div id="modal-with-images">
        <p id="close-popup-symbol" class="float-right modal-control-elements" title="Close">&nbsp;X&nbsp;</p><br>
        <span class="text-center"><img src="" alt="" /></span>
        <p id="images-gallery-info" class="float-right"></p>
    </div>
@endsection
