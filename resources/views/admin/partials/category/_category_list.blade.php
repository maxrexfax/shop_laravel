@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            {{ __('text.category_control') }}
            <a class="url_in_accordion ml-2 mb-0 float-right" href="{{route('category.create')}}">
                <span class="addButton" title="{{ __('text.add_new') }}">+</span>
            </a>
        </div>
        <div class="d-flex justify-content-between flex-wrap">
            <div class="col-12 p-0 overflow-auto">
                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>{{ __('actions.category_image') }}</th>
                        <th>{{ __('actions.category_name') }}</th>
                        <th>{{ __('actions.order') }}</th>
                        <th>{{ __('actions.parent_category') }}</th>
                        <th>{{ __('actions.edit') }}</th>
                        <th>{{ __('actions.delete') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories->sortBy('id') as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>
                                @if($category->category_logo)
                                    <img height="30px" src="{{ asset('/img/logo/' . $category->category_logo) }}" alt="{{$category->category_name}}"/>
                                @else
                                    <img height="30px" src="{{ asset('/img/empty.png') }}" alt="{{__('text.empty logo')}}"/>
                                @endif
                            </td>
                            <td>{{$category->category_name}}</td>
                            <td>{{$category->sort_number}}</td>
                            <td>{{$category->getParentCategoryName()}}</td>
                            <td><a href="{{ route('category.edit', ['id' => $category->id]) }}"><i class="fas fa-pencil-alt"></i></a></td>
                            <td>
                                <a href="{{route('category.destroy', ['id'=>$category->id])}}" title="{{__('text.delete')}}" data-confirm="{{__('actions.really_delete?')}}" class="btn btn-secondary float-right url-no-decoration btnToDeletePhone">
                                    <span><i class="fa fa-trash fa-lg" aria-hidden="true"></i></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="class-text-center">
            @if(!empty($categories))
                {{ $categories->links() }}
            @endif
        </div>
    </div>
@endsection
