<div class="w-100 pl-5">
    <div class="row">
            <div class="dropdown-el">
                <span class="dropdown-header">Lang</span>
                <div class="dropdown-content">
                    @foreach($locales as $locale)
                        <a title="{{$locale->locale_name}}" class="dropdown-item language{{ app()->getLocale()==$locale->locale_code ? ' active' : '' }}" href="{{route('main.page')}}/locale/{{$locale->locale_code}}">{{$locale->locale_code}}</a>
                    @endforeach
                </div>
            </div>

        <div class="dropdown-el pl-5">
            <span class="dropdown-header">Curr</span>
            <div class="dropdown-content">
                @foreach($currencies as $currency)
                    <a class="dropdown-item" href="#" title="{{$currency->currency_name}}">{{$currency->currency_code}}</a>
                @endforeach
            </div>
        </div>

        <span class="dropdown-header pl-5">Currency: {{$activeCurrency->currency_name}}</span>
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
        padding: 3px 5px;
        z-index: 1;
        border-radius: 5px;
    }

    .dropdown-el:hover .dropdown-content {
        display: block;
    }

    .dropdown-item {
        border-radius: 5px;
    }

    .dropdown-item:hover {
        background-color: aquamarine;
        border-radius: 5px;
    }

    .active {
        font-weight: bold !important;
        color: white !important;
    }

    .dropdown-header {
        font-weight: bold !important;
        margin: 0;
        padding: 0;
        color: #1b1e21;
    }
</style>
