@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">{{$NameOfForm}}</div>
        <div class="d-flex justify-content-between flex-wrap">
            <div class="col-6 col-md-10 col-sm-12">
                <form method="POST" enctype="multipart/form-data" action="{{ route('product.store') }}@if(!empty($product))/{{$product->id}}@endif">
                        @csrf

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Product ID') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="number" class="form-control @error('id') is-invalid @enderror" name="id" value="@if(!empty($product)){{$product->id}}@endif" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('Product name') }}</label>

                            <div class="col-md-6">
                                <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="@if(!empty($product)){{$product->product_name}}@endif" required>
                                @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rating" class="col-md-4 col-form-label text-md-right">{{ __('Rating') }}</label>

                            <div class="col-md-6">
                                <input id="rating" type="number" min="0" max="5" class="form-control @error('rating') is-invalid @enderror" name="rating" value="@if(!empty($product)){{$product->rating}}@endif" required>
                                @error('rating')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" value="@if(!empty($product)){{$product->price}}@endif" required>
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="@if(!empty($product)){{$product->title}}@endif" required>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="@if(!empty($product)){{$product->description}}@endif" required>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="short_description" class="col-md-4 col-form-label text-md-right">{{ __('Short description') }}</label>

                            <div class="col-md-6">
                                <input id="short_description" type="text" class="form-control @error('short_description') is-invalid @enderror" name="short_description" value="@if(!empty($product)){{$product->short_description}}@endif" required>
                                @error('short_description')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="full_description" class="col-md-4 col-form-label text-md-right">{{ __('Full description') }}</label>

                            <div class="col-md-6">
                                <input id="full_description" type="text" class="form-control @error('full_description') is-invalid @enderror" name="full_description" value="@if(!empty($product)){{$product->full_description}}@endif" required>
                                @error('full_description')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Logo image') }}</label>
                        @if(isset($product))
                            @if($product->logo_image)
                                <div style="max-width: 300px; width: 100%;">
                                    <img width="100%" src="/img/logo/{{$product->logo_image}}" alt="{{$product->product_name}}" title="Current logo for {{$product->product_name}}"/>
                                </div>
                            @else
                                No current logo image!
                            @endif
                        @endif
                        </div>


                        <div class="form-group row">
                            <label for="logo_image" class="col-md-4 col-form-label text-md-right">{{ __('Change logo image') }}</label>

                            <div class="col-md-6">
                                <input id="logo_image" type="file" class="form-control @error('logo_image') is-invalid @enderror" name="logo_image" title="Upload logo picture">
                                @error('logo_image')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categories" class="col-md-4 col-form-label text-md-right">{{ __('Categories') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="categories[]" id="categories" multiple>
                                    @foreach($categories as $category)
                                        @if(empty($product))
                                            <option id="{{$category->id}}">{{$category->category_name}}</option>
                                        @else
                                    <option value="{{$category->id}}"
                                    @foreach($product->categories as $productCategory)
                                        @if($productCategory->id==$category->id)
                                            selected
                                            @endif
                                        @endforeach
                                    >{{$category->category_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="images" class="col-md-4 col-form-label text-md-right">{{ __('Additional images') }}</label>

                            <div class="col-md-6">
                                <input type="file" name="images[]" title="Upload one or few pictures">
                            </div>
                        </div>

                        <div id="divForAdditionalImageInputs">
                        </div>

                        <div class="form-group row mb-2">
                            <div class="col-md-6 offset-md-4">
                                <p class="btn btn-secondary" id="btnToAddInput">
                                    {{ __('Add image') }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group row mb-0">

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ $alt_title }}
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
