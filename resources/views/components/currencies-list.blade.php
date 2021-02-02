<div>
    <div class="dropdown-el" title="{{__('actions.currency')}}">
            <span class="dropdown-header btn btn-success btn-sm" style="opacity: 0.6;">
                <i class="fas fa-wallet"></i> {{__('actions.currency')}}: {{ $defaultCurrency->currency_code}}
            </span>
        <div class="dropdown-content">
            @foreach($currencies as $currency)
                <a class="dropdown-item elFromListOfCurrencies" title="{{$currency->currency_name}}" href="{{ url('/set-currency', ['currency' => $currency->id]) }}">{{$currency->currency_code}}</a>
            @endforeach
        </div>
    </div>

</div>

<style>
    .dropdown-el {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #04530A;
        box-shadow: 0px 8px 16px 3px rgba(0,0,0,0.2);
        padding: 3px 2px;
        z-index: 1;
        border-radius: 5px;
    }

    .dropdown-el:hover .dropdown-content {
        display: block;
    }

    .dropdown-item {

    }

    .dropdown-item:hover {
        background-color: aquamarine;
        border-radius: 5px;
        font-weight: bold !important;
    }

    .dropdown-header {
        font-weight: bold !important;
        margin: 0;
        padding: 3px;
        color: #1b1e21;
    }
</style>
