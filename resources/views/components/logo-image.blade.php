<div>
    <a href="{{route('main.page')}}">
        @if($activeStore)
            <img class="float-left" src="{{asset('/img/logo/' . $activeStore->store_logo)}}" alt="{{ __('messages.cool_medicines') }}" />
        @else
            <img class="float-left" src="{{asset('/img/header_logo.png')}}" alt="{{ __('messages.cool_medicines') }}" />
        @endif
    </a>
</div>
