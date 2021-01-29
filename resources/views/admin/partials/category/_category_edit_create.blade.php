@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">{{ __('text.category_control') }}</div>
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
                        <form method="POST" enctype="multipart/form-data" action="{{ route('category.store') }}@if(!empty($category))/{{$category->id}}@endif">
                            @csrf

                            <div class="form-group row">
                                <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('actions.category_id') }}</label>

                                <div class="col-md-6">
                                    <span class="form-control border-0">@if(!empty($category)){{$category->id}}@endif</span>
                                    <input id="id" type="hidden" name="id" value="@if(!empty($category)){{$category->id}}@endif">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category_name" class="col-md-4 col-form-label text-md-right">{{ __('actions.category_name') }}</label>

                                <div class="col-md-6">
                                    <input id="category_name" type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="@if(!empty($category)){{$category->category_name}}@endif" required>
                                    @error('category_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sort_number" class="col-md-4 col-form-label text-md-right">{{ __('actions.category_sort_number') }}</label>

                                <div class="col-md-6">
                                    <input id="sort_number" type="number" class="form-control @error('password') is-invalid @enderror" name="sort_number" value="@if(!empty($category)){{$category->sort_number}}@endif" required>
                                    @error('sort_number')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('actions.logo_image') }}</label>
                                @if(isset($category))
                                    <div style="max-width: 300px; width: 100%;">
                                    @if($category->category_logo)
                                            <img width="100%" src="{{asset('/img/logo/' . $category->category_logo)}}" alt="{{$category->category_name}}" title="{{__('text.current_logo_for')}} {{$category->category_name}}"/>
                                    @else
                                        {{__('text.no_current_logo_image!')}}
                                    @endif
                            </div>
                                @endif
                            </div>


                            <div class="form-group row">
                                <label for="category_logo" class="col-md-4 col-form-label text-md-right">{{ __('text.change_category_logo_image') }}</label>

                                <div class="col-md-6">
                                    <input id="category_logo" type="file" class="form-control @error('category_logo') is-invalid @enderror" name="category_logo" title="{{__('actions.upload_logo_picture')}}">
                                    @error('category_logo')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('actions.parent_category') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option value=""
                                                @if(empty($category->category_id))
                                                selected
                                            @endif
                                        >{{ __('actions.parent_category') }}</option>
                                        @foreach($categories as $categoryInLoop)
                                            @if(empty($category))
                                                <option value="{{$categoryInLoop->id}}">{{$categoryInLoop->category_name}}</option>
                                            @else
                                                @if($category->id!=$categoryInLoop->id)
                                                    <option value="{{$categoryInLoop->id}}"
                                                            @if($category->category_id == $categoryInLoop->id)
                                                            selected
                                                        @endif
                                                    >{{$categoryInLoop->category_name}}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category_description" class="col-md-4 col-form-label text-md-right">{{ __('actions.description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="category_description" class="form-control" rows="3" cols="65" name="category_description">@if(!empty($category)){{$category->category_description}}@endif</textarea>
                                    @error('category_description')
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
