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
                    <form method="POST" enctype="multipart/form-data" action="{{ route('locale.store') }}@if(!empty($locale))/{{$locale->id}}@endif">
                        @csrf

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Locale ID') }}</label>

                            <div class="col-md-6">
                                <span class="form-control border-0">@if(!empty($locale)){{$locale->id}}@endif</span>
                                <input id="id" type="hidden" name="id" value="@if(!empty($locale)){{$locale->id}}@endif">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="locale_name" class="col-md-4 col-form-label text-md-right">{{ __('Locale name') }}</label>

                            <div class="col-md-6">
                                <input id="locale_name" type="text" class="form-control @error('locale_name') is-invalid @enderror" name="locale_name" value="@if(!empty($locale)){{$locale->locale_name}}@endif" required>
                                @error('locale_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="locale_code" class="col-md-4 col-form-label text-md-right">{{ __('Locale code') }}</label>

                            <div class="col-md-6">
                                <input id="locale_code" type="text" class="form-control @error('locale_code') is-invalid @enderror" name="locale_code" value="@if(!empty($locale)){{$locale->locale_code}}@endif" required>
                                @error('locale_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Logo image') }}</label>
                            @if(isset($locale))
                                <div style="max-width: 300px; width: 100%;">
                                    @if($locale->locale_logo)
                                        <img width="100%" src="{{asset('/img/logo/' . $locale->locale_logo)}}" alt="{{$locale->locale_logo}}" title="Current logo for {{$locale->locale_name}}"/>
                                    @else
                                        No current logo image!
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="locale_logo" class="col-md-4 col-form-label text-md-right">{{ __('Change category logo image') }}</label>

                            <div class="col-md-6">
                                <input id="store_logo" type="file" class="form-control @error('locale_logo') is-invalid @enderror" name="locale_logo" title="Upload logo picture">
                                @error('locale_logo')
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