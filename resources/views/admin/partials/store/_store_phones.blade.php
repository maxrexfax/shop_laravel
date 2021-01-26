@extends('admin.index')
@section('admin.content')
<div class="card">
    <div class="card-header text-center">
        {{__('Edit phone list for ')}}{{$store->store_name}}
    <span id="btnAddPhone" title="Add new phone" class="float-right btn btn-secondary">{{__('Add phone')}}<i class="fa fa-plus-square fa-lg ml-2" aria-hidden="true"></i></span>
    </div>
    <div class="d-flex justify-content-between flex-wrap">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="errors text-center bg-danger">
                @if($errors)
                    @foreach($errors->all() as $error)
                        {{$error}}
                    @endforeach
                @endif
            </div>
                    @foreach($phones as $phone)
                <div class="card-body border-bottom">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('phone.store') }}@if(!empty($phone))/{{$phone->id}}@endif">
                        @csrf
                        <input type="hidden" name="store_id" value="{{$store->id}}">
                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone number') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="phone_number" value="@if(!empty($phone)){{$phone->phone_number}}@endif" required>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" title="Edit this phone" class="btn btn-primary">
                                    <i class="fa fa-pencil-square fa-lg" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="col-md-1">
                                <a href="{{route('phone.delete', ['id'=>$phone->id])}}" title="Delete this phone" onclick="return confirm('Really delete?')" class="btn btn-secondary float-right url_no_decoration">
                                    <span><i class="fa fa-trash fa-lg" aria-hidden="true"></i></span>
                                </a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_info" class="col-md-4 col-form-label text-md-right">{{ __('Phone info') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('phone_info') is-invalid @enderror" name="phone_info" value="@if(!empty($phone)){{$phone->phone_info}}@endif" required>
                                @error('phone_info')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                    </form>
                </div>
                    @endforeach
        </div>
    </div>
</div>
<div>
    <div id="shadowPhones"></div>
    <div id="modalFormAddPhone" class="bg-white">
        <p id="closePopupSymbol" class="float-right btnCloseModal" title="Close"><i class="fa fa-window-close" aria-hidden="true"></i></p>
        <div class="card-body m-1 p-1">
            <form method="POST" action="{{ route('phone.store') }}">
                @csrf
                <input type="hidden" name="store_id" value="{{$store->id}}">
                <div class="form-group row">
                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('New phone number') }}</label>

                    <div class="col-md-6">
                        <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" placeholder="10 digits only!" name="phone_number" value="" required>
                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone_info" class="col-md-4 col-form-label text-md-right">{{ __('New phone info') }}</label>
                    <div class="col-md-6">
                        <input id="phone_info" type="text" class="form-control @error('phone_info') is-invalid @enderror" name="phone_info" value="" required>
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
                            {{ __('Add new phone') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
