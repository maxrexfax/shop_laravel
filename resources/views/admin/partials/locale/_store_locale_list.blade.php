@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            <a href="{{route('admin.stores.list', ['id'=>$store->id])}}" title="{{__('text.back_to_stores_list')}}" class="btn btn-secondary float-left url-no-decoration">
                {{__('actions.back_to_stores_list')}}
            </a>
            {{__('text.edit_languages_list_for')}} <span class="font-weight-bold">{{$store->store_name}}</span>
        </div>
            <div class="col-lg-12 col-md-12 col-sm-12 pb-2">
                @include('admin.partials._language_currency_locale_switcher')
                        <form method="POST" id="formToAddLocales" action="{{ route('store.locales.store', ['id' => $store->id]) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right"> </label>
                                <div class="col-md-10 offset-md-1 mt-2">
                                    <div id="divWithLocalesList" class="border rounded p-2">
                                        <p class="text-center">{{__('text.current_store_locales:')}}</p>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>{{__('actions.locale')}}</th>
                                                <th class="text-center">{{__('actions.default?')}}</th>
                                                <th class="text-center">{{__('actions.delete')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbodyWithLocales">
                                        @foreach($store->locales as $locale)
                                            <tr id="{{$locale->id}}">
                                                <td class="text-left pt-3"><p>{{$locale->locale_name}}</p></td>
                                                <td class="text-center">
                                                    <input class="d-none"
                                                           @if($locale->isDefault($store->id))
                                                           checked
                                                           @endif
                                                           name="default" id="radio{{$locale->id}}" type="radio" title="{{__('text.set_as_default_language_for_this_store')}}" value="{{$locale->id}}">
                                                    <label class="for-locale btn
                                                    @if($locale->isDefault($store->id))
                                                        btn-success
                                                    @endif
                                                    " for="radio{{$locale->id}}">{{__('Default')}}</label>
                                                    <input type="hidden" name="locales[]" value="{{$locale->id}}">
                                                </td>
                                                <td class="text-center"><i class="fa fa-minus-circle my-cursor-pointer i-tr-deleter" title="{{__('actions.delete_this_locale')}}"></i></td>
                                            </tr>
                                        @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-10 offset-md-1 text-center">
                                    <p>{{ __('actions.locales_to_add') }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7 offset-md-1">
                                    <select class="form-control" id="selectToAddLocaleToStoreDiv">
                                        @foreach($locales as $locale)
                                            <option value="{{$locale->id}}">{{$locale->locale_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 text-right">
                                    <span id="btnToAddLocaleToStoreDiv" data-confirm="{{__('text.already_in_use')}}" class="btn btn-secondary w-100">{{__('actions.add')}}</span>
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
