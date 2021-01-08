@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center mb-2">{{ __('Category control') }}</div>
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class ="container col-4">
                            <p><b>Current categories with relations</b></p>
                            <div style="overflow: auto; height: 400px;">
                                <ul>
                                    @foreach ($categoriesIer->sortBy('sort_number') as $cat)
                                        <li>{{ $cat->category_name }}</li>
                                        <ul>
                                            @foreach ($cat->childrenCategories as $childCategory)
                                                @include('admin.child_category', ['child_category' => $childCategory])
                                            @endforeach
                                        </ul>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-8">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                <tr>
                                    <th>{{ __('Category id') }}</th>
                                    <th>{{ __('Category name') }}</th>
                                    <th>{{ __('Sort number') }}</th>
                                    <th>{{ __('Parent number') }}</th>
                                    <th>{{ __('Edit') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories->sortBy('id') as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->category_name}}</td>
                                        <td>{{$category->sort_number}}</td>
                                        <td>{{$category->category_id}}</td>
                                        <td><a href="{{ route('admin.categories.edit') }}/{{$category->id}}"><i class="fas fa-pencil-alt"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
