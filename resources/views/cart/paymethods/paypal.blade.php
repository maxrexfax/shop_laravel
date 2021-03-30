<div class="form-group row m-0 p-0">
    <label for="creditCardNumber" class="col-md-12 col-form-label font-size-mini">{{ __('text.paypal_email') }}<span style="color: red">*</span></label>

    <div class="col-md-12 m-0 p-0">
        <input id="paypalEmail" type="text" class="w-100 @error('paypal_email') is-invalid @enderror" name="paypal_email" form="checkoutForm" placeholder="{{ __('text.paypal_email') }}" required>
        @error('paypal_email')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>