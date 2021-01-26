@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            {{ __('List of currency') }}
            <a class="url_in_accordion ml-2 mb-0 float-right" href="{{route('currency.create')}}">
                <span class="addButton" title="Add New">+</span>
            </a>
        </div>
        <div class="col-12 p-0">
            <table class="table table-striped w-100">
                <thead class="thead-dark">
                <tr>
                    <th>{{ __('Currency id') }}</th>
                    <th>{{ __('Currency name') }}</th>
                    <th>{{ __('Currency code') }}</th>
                    <th>{{ __('Currency value') }}</th>
                    <th>{{ __('Edit') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($currencies->sortBy('id') as $currency)
                    <tr>
                        <td>{{$currency->id}}</td>
                        <td>{{$currency->currency_name}}</td>
                        <td>{{$currency->currency_code}}</td>
                        <td>{{$currency->currency_value}}</td>
                        <td><a href="{{route('currency.create')}}/{{$currency->id}}"><i class="fas fa-pencil-alt"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            @if(!empty($currencies))
                {{ $currencies->links() }}
            @endif
        </div>
    </div>
@endsection
