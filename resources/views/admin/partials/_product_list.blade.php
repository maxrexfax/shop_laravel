@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            {{ __('List of products') }}
            <a class="url_in_accordion ml-2 mb-0 float-right" href="{{route('product.create')}}">
                <span class="addButton" title="Add New">+</span>
            </a>
        </div>
            <div class="col-12 p-0">
                <table class="table table-striped w-100">
                    <thead class="thead-dark">
                    <tr>
                        <th>{{ __('Product id') }}</th>
                        <th>{{ __('Product image') }}</th>
                        <th>{{ __('Product product_name') }}</th>
                        <th>{{ __('Product price') }}</th>
                        <th>{{ __('Product title') }}</th>
                        <th>{{ __('Product short_description') }}</th>
                        <th>{{ __('Product full_description') }}</th>
                        <th>{{ __('Product rating') }}</th>
                        <th>{{ __('Product images') }}</th>
                        <th>{{ __('Edit') }}</th>
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
                                    <img height="30px" src="/img/empty.png" alt="tmpalt"/>
                                @endif
                            </td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->title}}</td>
                            <td>{{$product->short_description}}</td>
                            <td>{{$product->full_description}}</td>
                            <td>{{$product->rating}}</td>
                            <td>Images list</td>
                            <td><a href="{{route('product.create')}}/{{$product->id}}"><i class="fas fa-pencil-alt"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        <div class="text-center">
            @if(!empty($products))
                {{ $products->links() }}
            @endif
        </div>
    </div>
@endsection
