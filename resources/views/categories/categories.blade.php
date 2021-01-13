@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ __('Category control') }}</div>
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class ="container col-3">
                            <p><b>Current categories with relations</b></p>
                            <p><i>Visual control of the current state</i></p>
                            <div style="overflow: auto; height: 400px;">
                                <ul>
                                    @foreach ($categoriesHierarchically->sortBy('sort_number') as $category)
                                        <li>{{ $category->category_name }}</li>
                                        <ul>
                                            @foreach ($category->childrenCategories as $childCategory)
                                                @include('categories.child_category_controll', ['child_category' => $childCategory])
                                            @endforeach
                                        </ul>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-9 p-0">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                <tr>
                                    <th>{{ __('Category id') }}</th>
                                    <th>{{ __('Category name') }}</th>
                                    <th>{{ __('Order') }}</th>
                                    <th>{{ __('Parent category') }}</th>
                                    <th>{{ __('Edit') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories->sortBy('id') as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->category_name}}</td>
                                        <td>{{$category->sort_number}}</td>
                                        <td>
                                            {{$category->getParentCategoryName()}}
                                        </td>
                                        <td><a href="{{ route('category.create') }}/{{$category->id}}"><i class="fas fa-pencil-alt"></i></a></td>
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
