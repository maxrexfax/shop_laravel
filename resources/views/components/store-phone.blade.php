<div>
    <div class="text-light font-weight-bold">
        <div class="dropdown-el">
            <span class="dropdown-header btn btn-success btn-sm text-white" style="opacity: 0.6;">
                <i class="fa fa-phone"></i><span class="mr-2"> {{__('text.phones')}}</span>
            </span>
            <div class="dropdown-content">
                @if($phones)
                    @forelse($phones as $phone)
                        <a class="my-dropdown-item mb-0 url_no_decoration phones-size-text text-white p-1" title="{{$phone->phone_info}}" href="tel:{{$phone->phone_number}}">{{$phone->phone_number}}</a>
                    @empty
                        <span class="dropdown-item">{{__('text.no_phone_number')}}</span>
                    @endforelse
                @else
                    <span>{{__('text.no_phone_number')}}</span>
                @endif
            </div>
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

    .phones-size-text {
        font-size: 0.9em;
    }
</style>
