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
                    <th>{{ __('text.paymethods_id') }}</th>
                    <th>{{ __('text.paymethods_pm_name') }}</th>
                    <th>{{ __('text.paymethods_other_data') }}</th>
                    <th>{{ __('text.edit') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($paymentMethods->sortBy('id') as $paymentMethod)
                    <tr>
                        <td>{{$paymentMethod->id}}</td>
                        <td>{{$paymentMethod->pm_name}}</td>
                        <td>{{$paymentMethod->other_data}}</td>
                        <td><a href="{{route('payment.method.create')}}/{{$paymentMethod->id}}"><i class="fas fa-pencil-alt"></i></a></td>
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
