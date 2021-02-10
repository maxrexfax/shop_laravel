<div class="text-light font-weight-bold">
    <div class="dropdown-el">
        <span class="dropdown-header btn btn-success btn-sm text-white" style="opacity: 0.6;">
            <i class="fa fa-phone"></i><span class="mr-2"> {{__('text.phones')}}</span>
        </span>
        <div class="dropdown-content">
            @if($phones)
                @forelse($phones as $phone)
                    <a class="my-dropdown-item mb-0 url-no-decoration phones-size-text text-white p-1" title="{{$phone->phone_info}}" href="tel:{{$phone->phone_number}}">{{$phone->phone_number}}</a>
                @empty
                    <span class="dropdown-item">{{__('text.no_phone_number')}}</span>
                @endforelse
            @else
                <span>{{__('text.no_phone_number')}}</span>
            @endif
        </div>
    </div>
</div>
