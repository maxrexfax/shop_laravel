@extends('layouts.app')
@section('content')
<div class="bg-white w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 div-img-modal-show p-0">
                        <div class="p-2">
                            <div class="text-center p-2">
                                    @if($product->logo_image)
                                        <img class="img-to-show-modal" height="300px" src="{{ asset('/img/logo/' . $product->logo_image)}}" alt="{{$product->product_name}}"/>
                                    @else
                                        <img height="200px" src="{{ asset('/img/empty.png')}}" alt="{{__('text.no_current_logo_image!')}}"/>
                                    @endif
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="text-center" style="width: 10%">
                                    @if(count($product->images)>0)
                                        <i id="leftScroll" class="fa fa-chevron-left arrows-scroll-class" aria-hidden="true"></i>
                                    @endif
                                </div>
                                <div class="d-flex div-icons-container" style="overflow: auto; width: 80%">
                                    @foreach($product->images as $img)
                                        <div class="border m-2">
                                            <img class="img-to-show-modal" height="100px" src="{{ asset('/img/images/' . $img->image_name) }}" alt="{{$img->image_name}}"/>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="text-center" style="width: 10%">
                                    @if(count($product->images)>0)
                                        <i id="rightScroll" class="fa fa-chevron-right arrows-scroll-class" aria-hidden="true"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 p-2">
                        <div class="product-right-banner rounded h-100 p-2">
                            <div class="w-100 overflow-hidden" style="max-height: 9%">
                                <h2 class="h-3">{{$product->product_name}}</h2>
                            </div>
                            <div class="clearfix">
                                <span class="float-left">{{__('text.item')}}:</span><span class="float-right text-dark font-weight-bold">{{__('text.in_stock')}}</span>
                            </div>
                            <hr>
                            <div class="">
                                <span class="text-dark font-weight-bold h3">{{$product->currentPrice()}}</span>
                            </div>
                            <br>
                            <div class="v-100 mb-2 text-muted" style="max-height: 30%; overflow-y: auto;">
                                <p>{{$product->short_description}}</p>
                            </div>
                            <div class="mt-2">
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <input class="form-control text-center" type="text" value="1" min="1" max="999">
                                    </div>
                                    <div class="col-md-9 mb-3">
                                        <span class="btn btn-primary w-100">{{__('actions.add_to_cart')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-muted font-italic"><i class="fa fa-heart-o" aria-hidden="true"></i> {{__('text.add_to_wishlist')}}</span>
                            </div>
                            <hr>
                            <div class="pl-2">
                                <span>{{__('text.share')}}:</span>
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 p-2">
                        <div class="product-main-description rounded p-0">
                            <div class="p-2">
                                <h3>{{__('text.description')}}</h3>
                            </div>
                            <div class="bg-light w-100 p-5 rounded-bottom">
                                <div>{!!$product->full_description!!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="place-holder"></section>
    <section class="place-holder"></section>
    <div id="shadow" class="d-none">
        <span class="modal-control-elements step-back" title="{{__('text.previous')}}">&#9664;</span>
        <span class="modal-control-elements step-forward" title="{{__('text.next')}}">&#9654;</span>
    </div>
    <div id="modalWithImages">
        <p id="closePopupSymbol" class="float-right modal-control-elements" title="Close"><i class="fa fa-window-close" aria-hidden="true"></i></p><br>
        <div style="max-width: 60%;" class="text-center"><img class="w-100" src="" alt="" /></div>
        <p id="imagesGalleryInfo" class="float-right text-white"></p>
    </div>
</div>
@endsection
