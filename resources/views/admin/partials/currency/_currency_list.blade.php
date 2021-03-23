@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            <a class="url_in_accordion ml-2 mb-0 float-left" href="{{route('currency.reload')}}">
                <span class="btn btn-secondary" title="{{ __('actions.re_new_currency_values') }}">{{ __('actions.re_new_values') }}</span>
            </a>
            {{ __('text.list_of_currency') }}
            <a class="url_in_accordion ml-2 mb-0 float-right" href="{{route('currency.create')}}">
                <span class="addButton" title="{{ __('text.add_new') }}">+</span>
            </a>
        </div>
        <div class="col-12 p-0 overflow-auto">
            <table class="table table-striped w-100">
                <thead class="thead-dark">
                <tr>
                    <th>{{ __('actions.currency_id') }}</th>
                    <th>{{ __('actions.currency_name') }}</th>
                    <th>{{ __('actions.currency_code') }}</th>
                    <th>{{ __('actions.currency_value') }}</th>
                    <th>{{ __('actions.edit') }}</th>
                    <th class="text-right">{{ __('actions.delete') }}</th>
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
                        <td>
                            <a href="{{route('currency.destroy', ['id'=>$currency->id])}}" title="{{__('text.delete')}}" data-confirm="{{__('actions.really_delete?')}}" class="btn btn-secondary float-right url-no-decoration btnToDeletePhone">
                                <span><i class="fa fa-trash fa-lg" aria-hidden="true"></i></span>
                            </a>
                        </td>
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
