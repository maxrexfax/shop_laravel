@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            {{ __('text.list_of_orders') }}
            <a class="url_in_accordion ml-2 mb-0 float-right" href="{{route('main.page')}}">
                <span class="addButton" title="{{ __('actions.home') }}">+</span>
            </a>
        </div>
        <div class="col-12 p-0 overflow-auto w-100">
            <table class="table table-striped w-100">
                <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>{{ __('text.first_name') }}</th>
                    <th>{{ __('text.email') }}</th>
                    <th>{{ __('text.city') }}</th>
                    <th>{{ __('text.view_order') }}</th>
                    <th>{{ __('actions.edit') }}</th>
                    <th class="text-right">{{ __('actions.delete') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders->sortBy('id') as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->first_name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->city}}</td>
                        <td>
                            <a href="{{route('order.show', ['id'=>$order->id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        </td>
                        <td><a href="{{route('order.edit', ['id'=>$order->id])}}"><i class="fas fa-pencil-alt"></i></a></td>
                        <td class="text-right">
                            <a href="{{route('order.destroy', ['id'=>$order->id])}}" title="{{__('text.delete')}}">
                                <span><i class="fa fa-trash fa-lg" aria-hidden="true"></i></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            @if(!empty($locales))
                {{ $locales->links() }}
            @endif
        </div>
    </div>
@endsection
