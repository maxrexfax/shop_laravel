@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            {{ __('actions.list_of_products') }}
            <a class="url_in_accordion ml-2 mb-0 float-right" href="{{route('product.create')}}">
                <span class="addButton" title="{{ __('actions.add_new') }}">+</span>
            </a>
        </div>
            <div class="col-12 p-0">
                <table class="table table-striped w-100 table-for-users-list">
                    <thead class="thead-dark">
                    <tr>
                        <th>{{ __('actions.product_id') }}</th>
                        <th>{{ __('actions.product_image') }}</th>
                        <th>{{ __('actions.product_name') }}</th>
                        <th>{{ __('actions.product_price') }}</th>
                        <th>{{ __('actions.product_title') }}</th>
                        <th>{{ __('actions.product_short_description') }}</th>
                        <th>{{ __('actions.product_rating') }}</th>
                        <th>{{ __('actions.edit') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products->sortBy('id') as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>
                                @if($product->logo_image)
                                    <img height="30px" src="{{ asset('/img/logo/' . $product->logo_image) }}" alt="{{$product->product_name}}"/>
                                @else
                                    <img height="30px" src="{{ asset('/img/empty.png') }}" alt="tmpalt"/>
                                @endif
                            </td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->title}}</td>
                            <td><div class="td-short-description">{{$product->short_description}}</div></td>
                            <td>{{$product->rating}}</td>
                            <td><a href="{{route('product.create', ['id' => $product->id])}}"><i class="fas fa-pencil-alt"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        <div class="col-sm-2 my-class-text-center">
            @if(!empty($products))
                {{ $products->links() }}
            @endif
        </div>
    </div>
@endsection
