@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            {{ __('text.list_of_paymethods') }}
            <a class="url_in_accordion ml-2 mb-0 float-right" href="{{route('payment.method.create')}}">
                <span class="addButton" title="{{ __('actions.add_new') }}">+</span>
            </a>
        </div>
        <div class="col-12 p-0">
            <table class="table table-striped w-100">
                <thead class="thead-dark">
                <tr>
                    <th>{{ __('text.paymethods_pm_name') }}</th>
                    <th>{{ __('text.paymethods_code') }}</th>
                    <th>{{ __('text.logo_image') }}</th>
                    <th>{{ __('text.paymethods_other_data') }}</th>
                    <th>{{ __('text.edit') }}</th>
                    <th class="text-right">{{ __('actions.delete') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($paymentMethods->sortBy('id') as $paymentMethod)
                    <tr>
                        <td>{{$paymentMethod->payment_method_name}}</td>
                        <td>{{$paymentMethod->payment_method_code}}</td>
                        <td>
                            @if($paymentMethod->logo)
                                <img height="30px" src="{{ asset('/img/logo/' . $paymentMethod->logo) }}" alt="{{$paymentMethod->payment_method_name}}"/>
                            @else
                                <img height="30px" src="{{ asset('/img/logo/empty_logo.jpg') }}" alt="{{ __('actions.no_logo') }}"/>
                            @endif
                        </td>
                        <td>{{$paymentMethod->other_data}}</td>
                        <td><a href="{{route('payment.method.create')}}/{{$paymentMethod->id}}"><i class="fas fa-pencil-alt"></i></a></td>
                        <td>
                            <a href="{{route('payment.destroy', ['id'=>$paymentMethod->id])}}" title="{{__('text.delete')}}" data-confirm="{{__('actions.really_delete?')}}" class="btn btn-secondary float-right url-no-decoration btnToDeletePhone">
                                <span><i class="fa fa-trash fa-lg" aria-hidden="true"></i></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            @if(!empty($paymentMethods))
                {{ $paymentMethods->links() }}
            @endif
        </div>
    </div>
@endsection
