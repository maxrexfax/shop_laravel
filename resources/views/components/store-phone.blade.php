<div>
    <div class="text-light font-weight-bold">
        <div class="dropdown-el">
            <span class="dropdown-header btn btn-success btn-sm" style="opacity: 0.6;">
                <i class="fa fa-phone"></i><span class="mr-2"> {{__('text.phones')}}</span>
            </span>
            <div class="dropdown-content">
                @if($phones)
                    @foreach($phones as $phone)
                        <a class="dropdown-item" title="{{$phone->phone_info}}" href="tel:{{$phone->phone_number}}">{{$phone->phone_number}}</a><br>
                    @endforeach
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
        padding: 3px 2px;
        z-index: 1;
        border-radius: 5px;
    }

    .dropdown-el:hover .dropdown-content {
        display: block;
    }

    .dropdown-item {

    }

    .dropdown-item:hover {
        background-color: aquamarine;
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
