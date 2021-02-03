<div>
    <div class="dropdown-el" title="{{__('actions.currency')}}">
            <span class="dropdown-header btn btn-success btn-sm text-white" style="opacity: 0.6;">
                <i class="fas fa-wallet"></i> {{__('actions.currency')}}: {{ $defaultCurrency->currency_code}}
            </span>
        <div class="dropdown-content">
            @foreach($currencies as $currency)
                <a class="my-dropdown-item url_no_decoration text-white p-1" title="{{$currency->currency_name}}" href="{{ url('/set-currency', ['currency' => $currency->id]) }}">{{$currency->currency_code}}</a>
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
        padding: 3px 6px;
        z-index: 1;
        border-radius: 5px;
    }

    .dropdown-el:hover .dropdown-content {
        display: block;
    }

    .dropdown-item {
        display: block;
        border-radius: 5px;

    }

    .my-dropdown-item:hover {
        background-color: darkslategray;
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
