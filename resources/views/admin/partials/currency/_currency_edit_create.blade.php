@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">{{ __('actions.currency_control') }}</div>
        <div class="d-flex justify-content-between flex-wrap">
            <div class="col-6 col-md-10 col-sm-12">
                <p class="text-center">
                    @if(isset($currency))
                    {{__('text.edit_currency')}} {{$currency->currency_name}}
                    @else
                        {{__('text.create_currency')}}
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
                    <form method="POST" enctype="multipart/form-data" action="{{ route('currency.store', ['id' => isset($currency) ? $currency->id : '']) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('actions.currency_id') }}</label>

                            <div class="col-md-6">
                                <span class="form-control border-0">@if(!empty($currency)){{$currency->id}}@endif</span>
                                <input id="id" type="hidden" name="id" value="@if(!empty($currency)){{$currency->id}}@endif">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="currency_name" class="col-md-4 col-form-label text-md-right">{{ __('actions.currency_name') }}</label>

                            <div class="col-md-6">
                                <input id="currency_name" type="text" class="form-control @error('currency_name') is-invalid @enderror" name="currency_name" value="@if(!empty($currency)){{$currency->currency_name}}@endif" required>
                                @error('currency_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="currency_code" class="col-md-4 col-form-label text-md-right">{{ __('actions.currency_code') }}</label>

                            <div class="col-md-6">
                                <input id="currency_code" type="text" class="form-control @error('currency_code') is-invalid @enderror" name="currency_code" value="@if(!empty($currency)){{$currency->currency_code}}@endif">
                                @error('currency_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="currency_value" class="col-md-4 col-form-label text-md-right">{{ __('actions.currency_value') }}</label>

                            <div class="col-md-6">
                                <input id="currency_value" type="number" min="0" max="99999" step="0.00001" class="form-control @error('currency_value') is-invalid @enderror" name="currency_value" value="@if(!empty($currency)){{$currency->currency_value}}@endif">
                                @error('currency_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="currency_symbol" class="col-md-4 col-form-label text-md-right">{{ __('actions.currency_symbol') }}</label>

                            <div class="col-md-6">
                                <input id="currency_symbol" type="text" class="form-control @error('currency_symbol') is-invalid @enderror" name="currency_symbol" value="@if(!empty($currency)){{$currency->currency_symbol}}@endif" required>
                                @error('currency_symbol')
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
