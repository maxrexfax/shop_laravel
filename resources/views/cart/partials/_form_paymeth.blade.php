<input type="radio" id="paymentMethod0" value="0" name="payment_method" class="payment-methods-select" form="checkoutForm" required>
<label for="paymentMethod0">{{__('text.make_a_choiсe')}}</label><br>
@if(!empty($paymentMethods))
@foreach($paymentMethods as $paymentMethod)
    <div id="{{$paymentMethod->id}}">
        <input type="radio" value="{{$paymentMethod->payment_code}}" name="payment_method" class="payment-methods-select" form="checkoutForm" required>
        <label for="paymentMethod{{$paymentMethod->id}}">{{$paymentMethod->pm_name}}</label><br>
        <div id="content{{$paymentMethod->id}}" class="details-for-payment-method"></div>
    </div>
@endforeach
@endif