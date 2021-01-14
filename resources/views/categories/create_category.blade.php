@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ __('Category create') }}</div>
                    <div class="d-flex justify-content-between flex-wrap">

                        <div class="col-6 col-md-10 col-sm-12">
                            <div class="card-body">
                                <form method="POST" action="{{ route('category.create') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="category_name" class="col-md-4 col-form-label text-md-right">{{ __('Category name') }}</label>

                                        <div class="col-md-6">
                                            <input id="category_name" type="text" class="form-control @error('catname') is-invalid @enderror" name="category_name" value="" placeholder="Enter category name" required>

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
                                            <input id="sort_number" type="number" class="form-control @error('password') is-invalid @enderror" name="sort_number" value="" required>

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
                                                <option value="0">Empty value</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Create') }}
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

