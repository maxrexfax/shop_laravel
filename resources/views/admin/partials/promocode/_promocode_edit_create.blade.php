@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">{{ __('text.locale_control') }}</div>
        <div class="d-flex justify-content-between flex-wrap">
            <div class="col-6 col-md-10 col-sm-12">
                <p class="text-center">
                    @if(isset($promocode))
                        {{__('text.edit_promocode')}} {{$promocode->promocode_name}}
                    @else
                        {{__('text.create_promocode')}}
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
                    <form method="POST" enctype="multipart/form-data" action="{{ route('promocode.store', ['id' => isset($promocode) ? $promocode->id : '']) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('actions.promocode_id') }}</label>

                            <div class="col-md-8">
                                <span class="form-control border-0">@if(!empty($promocode)){{$promocode->id}}@endif</span>
                                <input id="id" type="hidden" name="id" value="@if(!empty($promocode)){{$promocode->id}}@endif">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="promocode_name" class="col-md-4 col-form-label text-md-right">{{ __('actions.promocode_name') }}</label>

                            <div class="col-md-8">
                                <input id="promocode_name" type="text" class="form-control @error('promocode_name') is-invalid @enderror" name="promocode_name" value="@if(!empty($promocode)){{$promocode->promocode_name}}@endif" required>
                                @error('promocode_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="promocode_value" class="col-md-4 col-form-label text-md-right">{{ __('actions.promocode_value') }}</label>

                            <div class="col-md-8">
                                <input id="promocode_value" type="number" min="0" max="99" step="0.01" class="form-control @error('promocode_value') is-invalid @enderror" name="promocode_value" value="@if(!empty($promocode)){{$promocode->promocode_value}}@endif" required>
                                @error('promocode_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
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
