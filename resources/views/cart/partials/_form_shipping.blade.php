<input type="radio" id="deliveryType0" value="0" name="delivery_id" class="select-type-of-delivery-in-cart" form="checkoutForm" @if(empty($cart->deliveryId)) checked @endif>
<label for="deliveryType0">{{__('text.pickup')}}</label><br>
@if(!empty($deliveries))
@foreach($deliveries as $delivery)
    <input type="radio" id="deliveryType{{$delivery->id}}" value="{{$delivery->id}}" name="delivery_id"
           class="select-type-of-delivery-in-cart" form="checkoutForm" @if($cart->deliveryId == $delivery->id) checked @endif>
    <label for="deliveryType{{$delivery->id}}">{{$delivery->delivery_name}}</label><br>
@endforeach
@endif