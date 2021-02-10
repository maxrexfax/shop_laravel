<div class="form-group row">
    <div class="col-md-10 offset-md-1 mt-2">
        <div class="row d-flex justify-content-between flex-wrap pl-2 pr-2">
            <div class="col-lg-2 col-md-2 url-no-decoration w-100 mb-1 p-1">
                <a href="{{route('store.langlist', ['id' => $store->id])}}" title="{{__('text.edit_languages_for_this_store')}}" class="btn btn-info w-100">{{__('actions.languages')}}</a>
            </div>
            <div class="col-lg-2 col-md-2 url-no-decoration text-center w-100 mb-1 p-1">
                <a href="{{route('store.phonelist', ['id' => $store->id])}}" title="{{__('text.edit_phones_for_this_store')}}e" class="btn btn-info w-100">{{__('actions.phones')}}</a>
            </div>
            <div class="col-lg-2 col-md-2 url-no-decoration text-right w-100 mb-1 p-1">
                <a href="{{route('store.currencylist', ['id' => $store->id])}}" title="{{__('text.edit_currency_for_this_store')}}" class="btn btn-info w-100">{{__('actions.currencies')}}</a>
            </div>
            <div class="col-lg-2 col-md-2 url-no-decoration text-right w-100 mb-1 p-1">
                <a href="{{route('store.deliverylist', ['id' => $store->id])}}" title="{{__('text.edit_delivery')}}" class="btn btn-info w-100">{{__('text.delivery')}}</a>
            </div>
            <div class="col-lg-2 col-md-2 url-no-decoration text-right w-100 mb-1 p-1">
                <a href="{{route('store.create', ['id' => $store->id])}}" title="{{__('text.edit_other_store_data')}}" class="btn btn-info w-100">{{__('actions.edit')}} {{$store->store_name}}</a>
            </div>
        </div>
    </div>
</div>
