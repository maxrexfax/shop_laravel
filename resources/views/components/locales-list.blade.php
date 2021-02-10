<div>
    <div class="dropdown-el" title="{{__('actions.locale')}}">
            <span class="dropdown-header btn btn-success btn-sm text-white" style="opacity: 0.6;">
               <i class="fas fa-globe"></i> {{__('actions.locale')}}: {{ app()->getLocale()}}
            </span>
        <div class="dropdown-content">
            @foreach($locales as $locale)
                <a class="my-dropdown-item url-no-decoration text-white p-1" title="{{$locale->locale_name}}" href="{{ url('/locale', ['locale' => $locale->locale_code]) }}">{{$locale->locale_code}}</a>
                @endforeach
        </div>
    </div>
</div>

