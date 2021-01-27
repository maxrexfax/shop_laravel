@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            <a href="{{route('admin.stores.list', ['id'=>$store->id])}}" title="{{__('Back to all stores list')}}" class="btn btn-secondary float-left url_no_decoration">
                {{__('Back to stores list')}}
            </a>
            {{__('Edit languages list for ')}}<span class="font-weight-bold">{{$store->store_name}}</span>
        </div>
            <div class="col-lg-10 col-md-10 col-sm-12">
                <div class="row d-flex justify-content-between align-items-center p-2">
                    <div class="mt-2">
                        <form method="POST" id="formToAddLocales" action="{{ route('store.locales.store', ['id' => $store->id]) }}">
                            @csrf
                        <div class="form-group row">
                            <label for="categories" class="col-md-4 col-form-label text-md-right">{{ __('Categories of this product') }}</label>
                            <div class="col-md-6">
                                <div id="divWithLocalesList" class="p-2">
                                    @foreach($store->locales as $locale)
                                        <div id="{{$locale->id}}"><i class="fa fa-minus-circle my-cursor-pointer i-deleter" title="{{__('Delete this locale')}}"></i><span> {{$locale->locale_name}}</span>
                                            <input type="hidden" name="locales[]" value="{{$locale->id}}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="">
                        <select id="selectToAddLocaleToStoreDiv">
                            @foreach($locales as $locale)
                                <option value="{{$locale->id}}">{{$locale->locale_name}}</option>
                            @endforeach
                        </select>
                        <span id="btnToAddLocaleToStoreDiv" class="btn btn-secondary">{{__('Add locale to')}} {{$store->store_name}}</span>
                    </div>
                    <div class="">
                        <button class="btn btn-primary" type="submit" form="formToAddLocales">{{__('Save')}}</button>
                    </div>

                </div>
            </div>
    </div>
    <section class="place-holder"></section>
@endsection
