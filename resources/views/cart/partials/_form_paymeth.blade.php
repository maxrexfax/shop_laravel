<p>{{__('text.make_a_choiсe')}}:</p>
<input type="radio" id="paymentMethod0" value="0" name="payment_method" class="payment-methods-select" form="checkoutForm" required>
<label for="paymentMethod0">{{__('text.empty')}}</label><br>
@if(!empty($paymentMethods))
@foreach($paymentMethods as $paymentMethod)
    <div id="{{$paymentMethod->id}}">
        <img width="50px" class="float-right" src="{{ asset('/img/logo/' . $paymentMethod->logo)}}" title="{{$paymentMethod->payment_method_name}}" alt="{{$paymentMethod->payment_method_name}}"/>
        <input id="paymentMethod{{$paymentMethod->id}}" type="radio" value="{{$paymentMethod->payment_method_code}}" name="payment_method" class="payment-methods-select" form="checkoutForm" required>
        <label for="paymentMethod{{$paymentMethod->id}}">{{$paymentMethod->payment_method_name}}</label><br>
        <div id="content{{$paymentMethod->id}}" class="details-for-payment-method"></div>
    </div>
@endforeach
@endif