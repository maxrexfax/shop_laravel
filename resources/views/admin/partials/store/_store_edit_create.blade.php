@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">{{ __('Store control') }}</div>
        <div class="d-flex justify-content-between flex-wrap">
            <div class="col-6 col-md-10 col-sm-12">
                <p class="text-center">{{$alt_title}}</p>
                <div class="errors text-center bg-danger">
                    @if($errors)
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    @endif
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('store.store') }}@if(!empty($store))/{{$store->id}}@endif">
                        @csrf

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Store ID') }}</label>

                            <div class="col-md-6">
                                <span class="form-control border-0">@if(!empty($store)){{$store->id}}@endif</span>
                                <input id="id" type="hidden" name="id" value="@if(!empty($store)){{$store->id}}@endif">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="store_name" class="col-md-4 col-form-label text-md-right">{{ __('Store name') }}</label>

                            <div class="col-md-6">
                                <input id="store_name" type="text" class="form-control @error('store_name') is-invalid @enderror" name="store_name" value="@if(!empty($store)){{$store->store_name}}@endif" required>
                                @error('store_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="store_keywords" class="col-md-4 col-form-label text-md-right">{{ __('Store keywords') }}</label>

                            <div class="col-md-6">
                                <input id="store_keywords" type="text" class="form-control @error('store_keywords') is-invalid @enderror" name="store_keywords" value="@if(!empty($store)){{$store->store_keywords}}@endif">
                                @error('store_keywords')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="store_description" class="col-md-4 col-form-label text-md-right">{{ __('Store description') }}</label>

                            <div class="col-md-6">
                                <input id="store_description" type="text" class="form-control @error('store_description') is-invalid @enderror" name="store_description" value="@if(!empty($store)){{$store->store_description}}@endif">
                                @error('store_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Logo image') }}</label>
                            @if(isset($store))
                                <div style="max-width: 300px; width: 100%;">
                                    @if($store->store_logo)
                                        <img width="100%" src="{{asset('/img/logo/' . $store->store_logo)}}" alt="{{$store->store_name}}" title="Current logo for {{$store->store_name}}"/>
                                    @else
                                        No current logo image!
                                    @endif
                                </div>
                            @endif
                        </div>


                        <div class="form-group row">
                            <label for="store_logo" class="col-md-4 col-form-label text-md-right">{{ __('Change category logo image') }}</label>

                            <div class="col-md-6">
                                <input id="store_logo" type="file" class="form-control @error('store_logo') is-invalid @enderror" name="store_logo" title="Upload logo picture">
                                @error('store_logo')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
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
    </div>
@endsection
