@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">{{ __('actions.store_control') }}</div>
        <div class="d-flex justify-content-between flex-wrap">
            <div class="col-6 col-md-10 col-sm-12">
                <p class="text-center">
                    @if(isset($store))
                        {{__('text.edit_store')}} {{$store->store_name}}
                    @else
                        {{__('text.create_store')}}
                    @endif
                </p>
                <div class="errors text-center bg-danger">
                    @if($errors)
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    @endif
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="@if(!isset($store)){{ route('store.store')}} @else {{ route('store.update', ['id' => $store->id])}} @endif">

                        @csrf

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('actions.store_id') }}</label>

                            <div class="col-md-6">
                                <span class="form-control border-0">@if(!empty($store)){{$store->id}}@endif</span>
                                <input id="id" type="hidden" name="id" value="@if(!empty($store)){{$store->id}}@endif">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="store_name" class="col-md-4 col-form-label text-md-right">{{ __('actions.store_name') }}</label>

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
                            <label for="store_keywords" class="col-md-4 col-form-label text-md-right">{{ __('actions.store_keywords') }}</label>

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
                            <label for="store_description" class="col-md-4 col-form-label text-md-right">{{ __('actions.store_description') }}</label>

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
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('text.logo_image') }}</label>
                            @if(isset($store))
                                <div style="max-width: 100px; width: 100%;">
                                    @if($store->store_logo)
                                        <img width="100%" src="{{asset('/img/logo/' . $store->store_logo)}}" alt="{{$store->store_name}}" title="{{__('current_logo_for')}} {{$store->store_name}}"/>
                                    @else
                                        {{__('text.no_current_logo_image!')}}
                                    @endif
                                </div>
                            @endif
                        </div>


                        <div class="form-group row">
                            <label for="store_logo" class="col-md-4 col-form-label text-md-right">{{ __('text.change_store_logo_image') }}</label>

                            <div class="col-md-6">
                                <input id="store_logo" type="file" class="form-control p-1 @error('store_logo') is-invalid @enderror" name="store_logo" title="{{__('actions.upload_logo_picture')}}">
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
                                    {{ __('actions.save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
