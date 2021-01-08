@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ __('Category control') }}</div>
                    <div class="d-flex justify-content-between flex-wrap">

                        <div class="col-6 col-md-10 col-sm-12">
                            <p class="text-center">Category editing</p>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.savecategory') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Category ID') }}</label>

                                        <div class="col-md-6">
                                            <input id="id" type="number" class="form-control @error('name') is-invalid @enderror" name="id" value="{{$category->id}}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="category_name" class="col-md-4 col-form-label text-md-right">{{ __('Category name') }}</label>

                                        <div class="col-md-6">
                                            <input id="category_name" type="text" class="form-control @error('catname') is-invalid @enderror" name="category_name" value="{{$category->category_name}}" required>

                                            @error('category_name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="sort_number" class="col-md-4 col-form-label text-md-right">{{ __('Category sort number') }}</label>

                                        <div class="col-md-6">
                                            <input id="sort_number" type="number" class="form-control @error('password') is-invalid @enderror" name="sort_number" value="{{$category->sort_number}}" required>

                                            @error('sort_number')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Parent category') }}</label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="category_id" id="category_id">
                                                <option value="0"
                                                @if(empty($category->category_id))
                                                    selected
                                                    @endif
                                                >Empty value</option>
                                                @foreach($categories as $cat)
                                                    @if($cat->id!=$category->id)
                                                    <option value="{{$cat->id}}"
                                                    @if($category->category_id == $cat->id)
                                                        selected
                                                            @endif
                                                    >{{$cat->category_name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Edit') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

