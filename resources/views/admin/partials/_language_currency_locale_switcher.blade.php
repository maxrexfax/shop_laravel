<div class="form-group row">
    <div class="col-md-8 offset-md-2 mt-2">
        <div class="text-center">

        </div>
        <div class="row">
            <div class="col-lg-3 url_no_decoration w-100 mb-1">
                <a href="{{route('store.langlist', ['id' => $store->id])}}" title="Edit languages for this store" class="btn btn-info w-100">{{__('Languages')}}</a>
            </div>
            <div class="col-lg-3 url_no_decoration text-center w-100 mb-1">
                <a href="{{route('store.phonelist', ['id' => $store->id])}}" title="Edit phones for this store" class="btn btn-info w-100">{{__('Phones')}}</a>
            </div>
            <div class="col-lg-3 url_no_decoration text-right w-100 mb-1">
                <a href="{{route('store.currencylist', ['id' => $store->id])}}" title="Edit currencies for this store" class="btn btn-info w-100">{{__('Currencies')}}</a>
            </div>
            <div class="col-lg-3 url_no_decoration text-right w-100 mb-1">
                <a href="{{route('store.create', ['id' => $store->id])}}" title="Edit other store data" class="btn btn-info w-100">{{__('Edit ')}}{{$store->store_name}}</a>
            </div>
        </div>
    </div>
</div>
