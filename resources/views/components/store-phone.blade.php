<div>
    <div class="text-light font-weight-bold"><i class="fa fa-phone"></i><span class="mr-2"> {{__('text.phone')}}
            @if($phone)
                {{$phone->phone_number}}
            @else
                +???????
            @endif
            </span>
    </div>
</div>
