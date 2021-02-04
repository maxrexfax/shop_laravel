@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ __('text.category_control') }}</div>
                    <div class="d-flex justify-content-between flex-wrap">

                        <div class="col-6 col-md-10 col-sm-12">
                            <p class="text-center">{{$NameOfForm}}</p>
                            <div class="card-body">
                                <form method="POST" action="{{ route('category.store') }}@if(!empty($category))/{{$category->id}}@endif">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('actions.category_id') }}</label>

                                        <div class="col-md-6">
                                            <input type="number" class="form-control @error('name') is-invalid @enderror" name="id" value="@if(!empty($category)){{$category->id}}@endif" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="category_name" class="col-md-4 col-form-label text-md-right">{{ __('actions.category_name') }}</label>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control @error('catname') is-invalid @enderror" name="category_name" value="@if(!empty($category)){{$category->category_name}}@endif" required>
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
                                            <input type="number" class="form-control @error('password') is-invalid @enderror" name="sort_number" value="@if(!empty($category)){{$category->sort_number}}@endif" required>
                                            @error('sort_number')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('actions.category_id') }}</label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="category_id">
                                                <option value=""
                                                @if(empty($category->category_id))
                                                    selected
                                                    @endif
                                                >Parent category</option>
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
            </div>
        </div>
    </div>
@endsection

