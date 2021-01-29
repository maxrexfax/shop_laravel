@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            <a href="{{route('admin.stores.list', ['id'=>$store->id])}}" title="{{__('Back to all stores list')}}" class="btn btn-secondary float-left url_no_decoration">
                {{__('Back to stores list')}}
            </a>
            {{__('Edit currency list for ')}}<span class="font-weight-bold">{{$store->store_name}}</span>
        </div>
            <div class="col-lg-12 col-md-12 col-sm-12 pb-2">
                @include('admin.partials._language_currency_locale_switcher')
                        <form method="POST" id="formToAddCurrency" action="{{ route('store.currency.store', ['id' => $store->id]) }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-8 offset-md-2 mt-2">
                                    <div id="divWithLocalesList" class="border rounded p-2">
                                        <p class="text-center">{{__('Current store locales:')}}</p>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>{{__('Currency')}}</th>
                                                <th class="text-center">{{__('Default?')}}</th>
                                                <th class="text-right">{{__('Delete')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbodyWithCurrency">
                                        @foreach($store->currencies as $currency)
                                            <tr id="{{$currency->id}}">
                                                <td class="pt-3"><p>{{$currency->currency_name}}</p></td>
                                                <td class="text-center">
                                                    <input class="d-none" name="default"
                                                           @if($currency->isDefault($store->id))
                                                                checked
                                                           @endif
                                                           id="radio{{$currency->id}}" type="radio" value="{{$currency->id}}">

                                                    <label class="for-locale btn
                                                    @if($currency->isDefault($store->id))
                                                        btn-success
                                                    @endif
                                                        " for="radio{{$currency->id}}">{{__('Default')}}</label>
                                                    <input type="hidden" name="currencies[]" value="{{$currency->id}}">
                                                </td>
                                                <td class="text-right"><i class="fa fa-minus-circle my-cursor-pointer i-tr-deleter" title="{{__('Delete this currency')}}"></i></td>
                                            </tr>
                                        @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8 offset-md-2 text-center">
                                    <p>{{ __('Currency to add') }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7 offset-md-2">
                                    <select class="form-control" id="selectToAddCurrencyToStoreDiv">
                                        @foreach($currencies as $currency)
                                            <option value="{{$currency->id}}">
                                                {{$currency->currency_name}}
                                                ({{$currency->currency_value}})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 text-right">
                                    <span id="btnToAddCurrencyToStoreDiv" class="btn btn-secondary">{{__('Add')}}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-8 offset-md-2 text-center">
                                    <button class="btn btn-primary" type="submit">{{__('Save currency list')}}</button>
                                </div>
                            </div>
                        </form>
            </div>
    </div>
    <section class="place-holder"></section>
@endsection
