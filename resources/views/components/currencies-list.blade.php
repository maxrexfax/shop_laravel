<div>
    <div class="dropdown-el" title="{{__('actions.currency')}}">
            <span class="dropdown-header btn btn-success btn-sm text-white" style="opacity: 0.6;">
                    <i class="fas fa-wallet"></i> {{__('actions.currency')}}:
                @if($defaultCurrency)
                    {{ $defaultCurrency->currency_code}}
                @endif
            </span>
        <div class="dropdown-content">
            @if($currencies)
                @foreach($currencies as $currency)
                    <a class="my-dropdown-item url-no-decoration text-white p-1" title="{{$currency->currency_name}}" href="{{ url('/set-currency', ['currency' => $currency->id]) }}">{{$currency->currency_code}}</a>
                @endforeach
            @endif
        </div>
    </div>
</div>

