<div>
    <div class="dropdown-el" title="{{__('actions.locale')}}">
            <span class="dropdown-header btn btn-success btn-sm text-white" style="opacity: 0.6;">
               <i class="fas fa-globe"></i> {{__('actions.locale')}}: {{ app()->getLocale()}}
            </span>
        <div class="dropdown-content">
            @foreach($locales as $locale)
                <a class="my-dropdown-item url_no_decoration text-white p-1" title="{{$locale->locale_name}}" href="{{ url('/locale', ['locale' => $locale->locale_code]) }}">{{$locale->locale_code}}</a>
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

    .my-dropdown-item {
        display: block;
        border-radius: 5px;
    }

    .my-dropdown-item:hover {
        background-color: darkslategray;
        border-radius: 5px;
    }

    .dropdown-header {
        font-weight: bold !important;
        margin: 0;
        padding: 3px;
        color: #1b1e21;
    }
</style>
