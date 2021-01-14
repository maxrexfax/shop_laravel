@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div>
                    <div class="h2 text-left">{{$product->product_name}} images</div>
                    <a class="text-right mb-2" href="{{route('product.create', ['id' => $product->id])}}">
                        <span class="btn btn-secondary">Back to product {{$product->product_name}}</span>
                    </a>
                </div>
                <div class="border row mt-2 rounded">
                    <div class="col-12 col-md-12 col-sm-12">
                        <div>
                            <div class="d-flex flex-wrap justify-content-start">
                                @if(count($images)>0)
                                    @foreach($images as $image)
                                        <div id="{{$image->id}}" class="border p-2 m-2 rounded">
                                            <a href="{{route('image.delete',  ['id' => $image->id])}}"><i class="fa fa-minus-circle my-cursor-pointer" title="Delete this image"></i></a>
                                            <div style="max-width: 200px; width: 100%;">
                                                <img width="100%" src="{{ asset('/img/images/' . $image->image_name)}}">
                                            </div>
                                            <input type="hidden" name="images[]" value="{{$image->id}}">
                                        </div>
                                    @endforeach
                                @else
                                    <h2 class="text-center">There are no additional images for this product!</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="border rounded m-3 p-2">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('image.store') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <div class="ml-2">
                                <label for="imageAdd">{{ __('Add image') }}</label>
                                    <br>
                                <div>
                                    <input type="file" name="imageAdd" title="Upload new picture">
                                </div>
                            </div>
                            <div class="mb-0">

                            <button type="submit" class="btn btn-secondary btn-sm m-2">
                                {{ __('Send file') }}
                            </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
