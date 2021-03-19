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

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('text.paymethods_id') }}</label>

                            <div class="col-md-6">
                                <span class="form-control border-0">@if(!empty($paymentMethod)){{$paymentMethod->id}}@endif</span>
                                <input id="id" type="hidden" name="id" value="@if(!empty($paymentMethod)){{$paymentMethod->id}}@endif">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pm_name" class="col-md-4 col-form-label text-md-right">{{ __('text.paymethods_pm_name') }}</label>

                            <div class="col-md-6">
                                <input id="pm_name" type="text" class="form-control @error('store_name') is-invalid @enderror" name="pm_name" value="@if(!empty($paymentMethod)){{$paymentMethod->pm_name}}@endif" required>
                                @error('store_name')
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
                                @error('store_keywords')
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
