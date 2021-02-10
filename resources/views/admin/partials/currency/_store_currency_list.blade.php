@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            <a href="{{route('admin.stores.list', ['id'=>$store->id])}}" title="{{__('text.back_to_stores_list')}}" class="btn btn-secondary float-left url-no-decoration">
                {{__('actions.back_to_stores_list')}}
            </a>
            {{__('text.edit_currency_list_for')}} <span class="font-weight-bold">{{$store->store_name}}</span>
        </div>
            <div class="col-lg-12 col-md-12 col-sm-12 pb-2">
                @include('admin.partials._language_currency_locale_switcher')
                        <form method="POST" id="formToAddCurrency" action="{{ route('store.currency.store', ['id' => $store->id]) }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-10 offset-md-1 mt-2">
                                    <div id="divWithLocalesList" class="border rounded p-2">
                                        <p class="text-center">{{__('text.current_store_locales:')}}</p>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>{{__('actions.currency')}}</th>
                                                <th class="text-center">{{__('actions.default?')}}</th>
                                                <th class="text-right">{{__('actions.delete')}}</th>
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
                                                        " for="radio{{$currency->id}}">{{__('actions.default')}}</label>
                                                    <input type="hidden" name="currencies[]" value="{{$currency->id}}">
                                                </td>
                                                <td class="text-right"><i class="fa fa-minus-circle my-cursor-pointer i-tr-deleter" title="{{__('actions.delete_this_currency')}}"></i></td>
                                            </tr>
                                        @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8 offset-md-2 text-center">
                                    <p>{{ __('actions.currency_to_add') }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8 offset-md-1">
                                    <select class="form-control" id="selectToAddCurrencyToStoreDiv">
                                        @foreach($currencies as $currency)
                                            <option value="{{$currency->id}}">
                                                {{$currency->currency_name}}
                                                ({{$currency->currency_value}})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 text-right">
                                    <span id="btnToAddCurrencyToStoreDiv" data-confirm="{{__('text.already_in_use')}}" class="btn btn-secondary w-100">{{__('actions.add')}}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-8 offset-md-2 text-center">
                                    <button class="btn btn-primary" type="submit">{{__('actions.save_currency_list')}}</button>
                                </div>
                            </div>
                        </form>
            </div>
    </div>
    <section class="place-holder"></section>
@endsection
