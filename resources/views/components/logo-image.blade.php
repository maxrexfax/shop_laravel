<div class="logo-container-in-header">
    <a href="{{route('main.page')}}">
        @if($activeStore)
            @if($activeStore->store_logo)
                <img class="float-left w-100" src="{{asset('/img/logo/' . $activeStore->store_logo)}}" alt="{{ __('messages.cool_medicines') }}" />
            @else
                <img class="float-left w-100" src="{{asset('/img/header_logo.png')}}" alt="{{ __('messages.cool_medicines') }}" />
            @endif
        @else
            <img class="float-left w-100" src="{{asset('/img/header_logo.png')}}" alt="{{ __('messages.cool_medicines') }}" />
        @endif
    </a>
</div>
