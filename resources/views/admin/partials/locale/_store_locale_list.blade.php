@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            <a href="{{route('admin.stores.list', ['id'=>$store->id])}}" title="{{__('Back to all stores list')}}" class="btn btn-secondary float-left url_no_decoration">
                {{__('Back to stores list')}}
            </a>
            {{__('Edit languages list for ')}}<span class="font-weight-bold">{{$store->store_name}}</span>
        </div>
            <div class="col-lg-12 col-md-12 col-sm-12 pb-2">


                        <form method="POST" id="formToAddLocales" action="{{ route('store.locales.store', ['id' => $store->id]) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right"> </label>
                                <div class="col-md-8 mt-2">
                                    <div id="divWithLocalesList" class="border rounded p-2">
                                        <p class="text-center">{{__('Current store locales:')}}</p>
                                        <table class="table table-stripped">
                                            <thead>
                                            <tr>
                                                <th>{{__('Locale')}}</th>
                                                <th class="text-center">{{__('Default?')}}</th>
                                                <th class="text-center">{{__('Delete')}}</th>
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
                                                           name="default" id="radio{{$locale->id}}" type="radio" title="{{__('Set as default language for this store')}}" value="{{$locale->id}}">
                                                    <label class="for-locale btn
                                                    @if($locale->isDefault($store->id))
                                                        btn-success
                                                    @endif
                                                    " for="radio{{$locale->id}}">{{__('Default')}}</label>
                                                    <input type="hidden" name="locales[]" value="{{$locale->id}}">
                                                </td>
                                                <td class="text-center"><i class="fa fa-minus-circle my-cursor-pointer i-tr-deleter" title="{{__('Delete this locale')}}"></i></td>
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
                                    <p>{{ __('Locales to add') }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="selectToAddLocaleToStoreDiv" class="col-md-2 col-form-label text-md-right"> </label>
                                <div class="col-md-7">
                                    <select class="form-control" id="selectToAddLocaleToStoreDiv">
                                        @foreach($locales as $locale)
                                            <option value="{{$locale->id}}">{{$locale->locale_name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-1">
                                    <span id="btnToAddLocaleToStoreDiv" class="btn btn-secondary">{{__('Add')}}</span>
                                </div>

                            </div>

                            <div class="form-group row mb-0">

                                <div class="col-md-8 offset-md-4">
                                    <button class="btn btn-primary" type="submit" form="formToAddLocales">{{__('Save locales list')}}</button>
                                </div>
                            </div>
                        </form>





            </div>
    </div>
    <section class="place-holder"></section>
@endsection
