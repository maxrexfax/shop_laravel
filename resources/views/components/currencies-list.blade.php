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

