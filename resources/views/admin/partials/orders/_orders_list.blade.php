@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            {{ __('text.list_of_orders') }}
            <a class="url_in_accordion ml-2 mb-0 float-right" href="{{route('order.create')}}">
                <span class="addButton" title="{{ __('actions.create') }}">+</span>
            </a>
        </div>
        <div class="col-12 p-0 overflow-auto w-100">
            <table id="tableWithOrdersData" class="table table-bordered w-100 table-orders-list">
                <thead class="thead-custom-dark">
                <tr>
                    <th>ID</th>
                    <th>{{ __('text.first_name') }}</th>
                    <th>{{ __('text.email') }}</th>
                    <th>{{ __('text.city') }}</th>
                    <th>{{ __('text.status') }}</th>
                    <th>{{ __('text.price') }}</th>
                    <th class="text-center">{{ __('text.view') }}</th>
                    <th class="text-center">{{ __('actions.edit') }}</th>
                    <th class="text-center">{{ __('actions.delete') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders->sortBy('id') as $order)
                    <tr class="tr-in-order-list">
                        <td>{{$order->id}}</td>
                        <td>{{$order->first_name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->city}}</td>
                        <td>{{$order->getStatus()->status_name}}</td>
                        <td>{{$order->orderPrice}}$</td>
                        <td class="text-center">
                            <a href="{{route('order.show', ['id' => $order->id])}}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                        </td>
                        <td class="text-center"><a href="{{route('order.edit', ['id' => $order->id])}}"><i class="fas fa-pencil-alt fa-lg"></i></a></td>
                        <td class="text-center">
                            <a href="{{route('order.destroy', ['id' => $order->id])}}" class="url-no-decoration" title="{{__('text.delete_finally')}}">
                                <span><i class="fa fa-trash fa-lg" aria-hidden="true"></i></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
