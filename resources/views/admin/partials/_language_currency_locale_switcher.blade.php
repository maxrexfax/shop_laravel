<div class="form-group row">
    <div class="col-md-8 offset-md-2 mt-2">
        <div class="text-center"></div>
        <div class="row">
            <div class="col-lg-3 url_no_decoration w-100 mb-1">
                <a href="{{route('store.langlist', ['id' => $store->id])}}" title="{{__('text.edit_languages_for_this_store')}}" class="btn btn-info w-100">{{__('actions.languages')}}</a>
            </div>
            <div class="col-lg-3 url_no_decoration text-center w-100 mb-1">
                <a href="{{route('store.phonelist', ['id' => $store->id])}}" title="{{__('text.edit_phones_for_this_store')}}e" class="btn btn-info w-100">{{__('actions.phones')}}</a>
            </div>
            <div class="col-lg-3 url_no_decoration text-right w-100 mb-1">
                <a href="{{route('store.currencylist', ['id' => $store->id])}}" title="{{__('text.edit_currency_for_this_store')}}" class="btn btn-info w-100">{{__('actions.currencies')}}</a>
            </div>
            <div class="col-lg-3 url_no_decoration text-right w-100 mb-1">
                <a href="{{route('store.create', ['id' => $store->id])}}" title="{{__('text.edit_other_store_data')}}" class="btn btn-info w-100">{{__('actions.edit')}} {{$store->store_name}}</a>
            </div>
        </div>
    </div>
</div>
