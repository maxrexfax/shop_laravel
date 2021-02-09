@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">{{ __('actions.currency_control') }}</div>
        <div class="d-flex justify-content-between flex-wrap">
            <div class="col-6 col-md-10 col-sm-12">
                <p class="text-center">
                    @if(isset($delivery))
                        {{__('text.edit_delivery')}} {{$delivery->delivery_name}}
                    @else
                        {{__('text.create_delivery')}}
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
                    <form id="formToAddDeliveries" method="POST" enctype="multipart/form-data" action="{{ route('delivery.store', ['id' => isset($delivery) ? $delivery->id : '']) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('actions.delivery_id') }}</label>

                            <div class="col-md-6">
                                <span class="form-control border-0">@if(!empty($delivery)){{$delivery->id}}@endif</span>
                                <input id="id" type="hidden" name="id" value="@if(!empty($delivery)){{$delivery->id}}@endif">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="delivery_name" class="col-md-4 col-form-label text-md-right">{{ __('actions.delivery_name') }}</label>

                            <div class="col-md-6">
                                <input id="delivery_name" type="text" class="form-control @error('delivery_name') is-invalid @enderror" name="delivery_name" value="@if(!empty($delivery)){{$delivery->delivery_name}}@endif" required>
                                @error('delivery_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="delivery_description" class="col-md-4 col-form-label text-md-right">{{ __('actions.delivery_description') }}</label>

                            <div class="col-md-6">
                                <input id="delivery_description" type="text" class="form-control @error('delivery_description') is-invalid @enderror" name="delivery_description" value="@if(!empty($delivery)){{$delivery->delivery_description}}@endif" required>
                                @error('delivery_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="delivery_price" class="col-md-4 col-form-label text-md-right">{{ __('text.delivery_price') }}</label>

                            <div class="col-md-6">
                                <input id="currency_value" type="number" min="0" max="99999" step="0.01" class="form-control @error('delivery_price') is-invalid @enderror" name="delivery_price" value="@if(!empty($delivery)){{$delivery->delivery_price}}@endif" required>
                                @error('store_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="active" class="col-md-4 col-form-label text-md-right">{{ __('text.is_delivery_enabled') }}</label>
                            <div class="col-md-6">
                                <select name="active" class="form-control">
                                    <option value="0"
                                    @if(!empty($delivery))
                                        @if(!$delivery->active)
                                            selected
                                        @endif
                                    @endif
                                    >{{__('text.disabled')}}</option>
                                    <option value="1"
                                    @if(!empty($delivery))
                                        @if($delivery->active)
                                            selected
                                        @endif
                                    @endif
                                    >{{__('text.enabled')}}</option>
                                </select>
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
