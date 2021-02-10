@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            <a href="{{route('admin.stores.list', ['id'=>$store->id])}}" title="{{__('text.back_to_stores_list')}}" class="btn btn-secondary float-left url-no-decoration">
                {{__('actions.back_to_stores_list')}}
            </a>
            {{__('text.edit_delivery_list_for')}} <span class="font-weight-bold">{{$store->store_name}}</span>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 pb-2">
            <div class="errors text-center bg-danger">
                @if($errors)
                    @foreach($errors->all() as $error)
                        {{$error}}
                    @endforeach
                @endif
            </div>
            @include('admin.partials._language_currency_locale_switcher')
            <form method="POST" id="formToAddLocales" action="{{ route('store.delivery.store', ['id' => $store->id]) }}">
                @csrf
                <div class="form-group row">

                    <div class="col-md-10 offset-md-1 mt-2">
                        <div id="divWithLocalesList" class="border rounded p-2">
                            <p class="text-center">{{__('text.current_store_delivery:')}}</p>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>{{__('text.delivery')}}</th>
                                    <th class="text-center">{{__('actions.delete')}}</th>
                                </tr>
                                </thead>
                                <tbody id="tbodyWithDeliveries">
                                @foreach($store->deliveries as $delivery)
                                    <tr id="{{$delivery->id}}">
                                        <td class="text-left pt-3"><p>{{$delivery->delivery_name}}</p></td>
                                        <td class="text-center">
                                            @if(!$delivery->active)
                                                <span class="font-italic">{{__('text.disabled')}}</span>
                                                @endif
                                            <i class="fa fa-minus-circle class-cursor-pointer i-tr-deleter" title="{{__('text.delete_this_delivery')}}"></i>
                                            <input type="hidden" name="deliveries[]" value="{{$delivery->id}}">
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="selectToAddLocaleToStoreDiv" class="col-md-2 col-form-label text-md-right"> </label>
                    <div class="col-md-8 text-center">
                        <p>{{ __('text.delivery_to_add') }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 offset-md-1">
                        <select class="form-control" id="selectToAddDeliveryToStoreDiv">
                            @foreach($deliveries as $delivery)
                                @if($delivery->active)
                                    <option value="{{$delivery->id}}">{{$delivery->delivery_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 text-right">
                        <span id="btnToAddDeliveryToStoreDiv" data-confirm="{{__('text.already_in_use')}}" class="btn btn-secondary w-100">{{__('actions.add')}}</span>
                    </div>
                </div>
                <div class="form-group row mb-0">

                    <div class="col-md-8 offset-md-4">
                        <button class="btn btn-primary" type="submit" form="formToAddLocales">{{__('actions.save_locales_list')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <section class="place-holder"></section>
@endsection
