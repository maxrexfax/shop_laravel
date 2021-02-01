@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            <a href="{{route('store.phonelist', ['id'=>$store->id])}}" title="{{__('text.back_to_phones_list')}}" class="btn btn-secondary float-left url_no_decoration">
                {{__('text.back_to_phones_list')}}
            </a>
            {{ __('actions.phone_control') }}
        </div>
        <div class="d-flex justify-content-between flex-wrap">
            <div class="col-6 col-md-10 col-sm-12">
                <p class="text-center">
                    @if(isset($phone))
                        {{__('text.edit_phone')}} {{$phone->phone_name}}
                    @else
                        {{__('text.create_phone')}}
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
                    <form method="POST" action="{{ route('phone.store') }}@if(!empty($phone))/{{$phone->id}}@endif">
                        @csrf

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('actions.phone_id') }}</label>

                            <div class="col-md-6">
                                <span class="form-control border-0">@if(!empty($phone)){{$phone->id}}@endif</span>
                                <input id="id" type="hidden" name="id" value="@if(!empty($phone)){{$phone->id}}@endif">
                                <input id="id" type="hidden" name="store_id" value="{{$store->id}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('actions.phone_number') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="@if(!empty($phone)){{$phone->phone_number}}@endif" required>
                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_info" class="col-md-4 col-form-label text-md-right">{{ __('actions.phone_info') }}</label>

                            <div class="col-md-6">
                                <input id="phone_info" type="text" class="form-control @error('phone_info') is-invalid @enderror" name="phone_info" value="@if(!empty($phone)){{$phone->phone_info}}@endif">
                                @error('phone_info')
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
