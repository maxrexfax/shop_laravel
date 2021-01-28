@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            {{ __('List of stores') }}
            <a class="url_in_accordion ml-2 mb-0 float-right" href="{{route('store.create')}}">
                <span class="addButton" title="Add New">+</span>
            </a>
        </div>
        <div class="col-12 p-0">
            <table class="table table-striped w-100">
                <thead class="thead-dark">
                <tr>
                    <th>{{ __('Store id') }}</th>
                    <th>{{ __('Store logo image') }}</th>
                    <th>{{ __('Store name') }}</th>
                    <th>{{ __('Store keywords') }}</th>
                    <th>{{ __('Store currency') }}</th>
                    <th>{{ __('Store languages') }}</th>
                    <th>{{ __('Store phones') }}</th>
                    <th>{{ __('Edit') }}</th>
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
                                <img height="30px" src="{{ asset('/img/empty.png') }}" alt="No logo"/>
                            @endif
                        </td>
                        <td>{{$store->store_name}}</td>
                        <td>{{$store->store_keywords}}</td>
                        <td><a class="btn btn-secondary url_no_decoration" href="{{route('store.currencylist', ['id' => $store->id])}}">{{ __('Currency') }}</a></td>
                        <td><a class="btn btn-secondary url_no_decoration" href="{{route('store.langlist', ['id' => $store->id])}}">{{ __('Languages') }}</a></td>
                        <td><a class="btn btn-secondary url_no_decoration" href="{{route('store.phonelist', ['id' => $store->id])}}">{{ __('Phones') }}</a></td>
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
