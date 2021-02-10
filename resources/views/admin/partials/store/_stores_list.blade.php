@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            {{ __('text.list_of_stores') }}
            <a class="url_in_accordion ml-2 mb-0 float-right" href="{{route('store.create')}}">
                <span class="addButton" title="{{__('actions.add_new')}}">+</span>
            </a>
        </div>
        <div class="col-12 p-0">
            <table class="table table-striped w-100">
                <thead class="thead-dark">
                <tr>
                    <th>{{ __('actions.store_id') }}</th>
                    <th>{{ __('actions.store_logo_image') }}</th>
                    <th>{{ __('actions.store_name') }}</th>
                    <th>{{ __('actions.store_keywords') }}</th>
                    <th>{{ __('actions.store_is_active') }}</th>
                    <th>{{ __('actions.store_delivery') }}</th>
                    <th>{{ __('actions.store_currency') }}</th>
                    <th>{{ __('actions.store_languages') }}</th>
                    <th>{{ __('actions.store_phones') }}</th>
                    <th>{{ __('actions.edit') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($stores->sortBy('id') as $store)
                    <tr>
                        <td>{{$store->id}}</td>
                        <td>
                            @if($store->store_logo)
                                <img height="30px" src="{{ asset('/img/logo/' . $store->store_logo) }}" alt="{{$store->store_name}}"/>
                            @else
                                <img height="30px" src="{{ asset('/img/empty.png') }}" alt="{{ __('actions.no_current_logo_image!') }}"/>
                            @endif
                        </td>
                        <td>{{$store->store_name}}</td>
                        <td>{{$store->store_keywords}}</td>
                        <td>
                            @if($store->active)
                                <a href="{{route('store.changeactive', ['id' => $store->id])}}" class="btn btn-primary url-no-decoration" title="{{__('actions.turn_off')}}">{{__('actions.active')}}</a>
                            @else
                                <a href="{{route('store.changeactive', ['id' => $store->id])}}" class="btn btn-secondary url-no-decoration" title="{{__('actions.turn_on')}}">{{__('actions.turned_off')}}</a>
                            @endif
                        </td>
                        <td><a class="btn btn-secondary url-no-decoration" href="{{route('store.deliverylist', ['id' => $store->id])}}">{{ __('actions.deliveries') }}</a></td>
                        <td><a class="btn btn-secondary url-no-decoration" href="{{route('store.currencylist', ['id' => $store->id])}}">{{ __('actions.currency') }}</a></td>
                        <td><a class="btn btn-secondary url-no-decoration" href="{{route('store.langlist', ['id' => $store->id])}}">{{ __('actions.languages') }}</a></td>
                        <td><a class="btn btn-secondary url-no-decoration" href="{{route('store.phonelist', ['id' => $store->id])}}">{{ __('actions.phones') }}</a></td>
                        <td><a href="{{route('store.create')}}/{{$store->id}}"><i class="fas fa-pencil-alt"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            @if(!empty($stores))
                {{ $stores->links() }}
            @endif
        </div>
    </div>
@endsection
