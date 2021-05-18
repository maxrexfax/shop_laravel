@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">{{ __('text.payment_methods_control') }}</div>
        <div class="d-flex justify-content-between flex-wrap">
            <div class="col-6 col-md-10 col-sm-12">
                <p class="text-center">
                    @if(isset($store))
                        {{__('text.edit_payment_methods')}} {{$store->store_name}}
                    @else
                        {{__('text.create_payment_methods')}}
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
                    <form method="POST" enctype="multipart/form-data" action="{{ route('payment.method.store', ['id' => isset($paymentMethod) ? $paymentMethod->id : '']) }}">
                        @csrf
                        <input id="id" type="hidden" name="id" value="@if(!empty($paymentMethod)){{$paymentMethod->id}}@endif">

                        <div class="form-group row">
                            <label for="payment_method_name" class="col-md-4 col-form-label text-md-right">{{ __('text.paymethods_pm_name') }}</label>

                            <div class="col-md-6">
                                <input id="payment_method_name" type="text" class="form-control @error('payment_method_name') is-invalid @enderror" name="payment_method_name" value="@if(!empty($paymentMethod)){{$paymentMethod->payment_method_name}}@endif" required>
                                @error('payment_method_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="payment_method_code" class="col-md-4 col-form-label text-md-right">{{ __('text.paymethods_code') }}</label>

                            <div class="col-md-6">
                                <input id="payment_method_code" type="text" class="form-control @error('payment_method_code') is-invalid @enderror" name="payment_method_code" value="@if(!empty($paymentMethod)){{$paymentMethod->payment_method_code}}@endif">
                                @error('payment_method_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="other_data" class="col-md-4 col-form-label text-md-right">{{ __('text.paymethods_other_data') }}</label>

                            <div class="col-md-6">
                                <input id="other_data" type="text" class="form-control @error('store_keywords') is-invalid @enderror" name="other_data" value="@if(!empty($paymentMethod)){{$paymentMethod->other_data}}@endif">
                                @error('other_data')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('text.logo_image') }}</label>
                            <div class="col-md-6">
                                @if(isset($paymentMethod))
                                    @if($paymentMethod->logo)
                                        <div style="max-width: 50px; width: 100%;">
                                            <img width="100%" src="{{ asset('/img/logo/' . $paymentMethod->logo) }}" alt="{{$paymentMethod->payment_method_name}}" title="Current logo for {{$paymentMethod->payment_method_name}}"/>
                                        </div>
                                        <input type="hidden" name="logoExist" value="1">
                                    @else
                                        {{__('text.no_current_logo_image!')}}
                                    @endif

                                @else
                                    <input type="hidden" name="logoExist" value="0">
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('text.change_logo_image') }}</label>

                            <div class="col-md-6">
                                <input id="logo" type="file" class="form-control p-1 @error('logo') is-invalid @enderror" name="logo" title="{{ __('text.upload_logo_picture') }}">
                                @error('logo')
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
