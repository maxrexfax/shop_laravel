@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            {{ __('text.list_of_deliveries') }}
            <a class="url_in_accordion ml-2 mb-0 float-right" href="{{route('delivery.create')}}">
                <span class="addButton" title="{{ __('actions.add_new') }}">+</span>
            </a>
        </div>
        <div class="col-12 p-0">
            <table class="table table-striped w-100">
                <thead class="thead-dark">
                <tr>
                    <th>{{ __('actions.delivery_id') }}</th>
                    <th>{{ __('actions.delivery_name') }}</th>
                    <th>{{ __('actions.delivery_description') }}</th>
                    <th>{{ __('actions.price') }}</th>
                    <th>{{ __('actions.active') }}</th>
                    <th>{{ __('actions.edit') }}</th>
                    <th>{{ __('actions.delete') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($deliveries->sortBy('id') as $delivery)
                    <tr>
                        <td>{{$delivery->id}}</td>
                        <td>{{$delivery->delivery_name}}</td>
                        <td>{{$delivery->delivery_description}}</td>
                        <td>{{$delivery->delivery_price}}</td>
                        <td>
                            @if($delivery->active)
                                <span class="btn btn-success">{{__('text.enabled')}}</span>
                            @else
                                <span class="btn btn-secondary">{{__('text.disabled')}}</span>
                            @endif
                            </td>
                        <td>
                            <a href="{{route('delivery.create', ['id' => $delivery->id])}}" title="{{__('text.edit_delivery')}}"><i class="fas fa-pencil-alt"></i></a>
                            <a href="{{route('delivery.destroy', ['id'=>$delivery->id])}}" title="{{__('text.delete_this_delivery')}}" data-confirm="{{__('actions.really_delete?')}}" class="btn btn-secondary float-right url-no-decoration btnToDeletePhone">
                                <span><i class="fa fa-trash fa-lg" aria-hidden="true"></i></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            @if(!empty($deliveries))
                {{ $deliveries->links() }}
            @endif
        </div>
    </div>
@endsection
