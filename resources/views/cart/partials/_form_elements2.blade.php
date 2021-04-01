<div class="form-group row m-0 p-0">
    <label for="address_additional" class="col-md-12 col-form-label font-size-mini">{{ __('text.address_additional') }}</label>

    <div class="col-md-12 m-0 p-0">
        <input id="address_additional" type="text" class="w-100 @error('address_additional') is-invalid @enderror" name="address_additional" value="Addit addr" form="checkoutForm" placeholder="Address" required autocomplete="address_additional">
        @error('address_additional')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row m-0 p-0">
    <label for="city" class="col-md-12 col-form-label font-size-mini">{{ __('text.city') }}<span style="color: red">*</span></label>

    <div class="col-md-12 m-0 p-0">
        <input id="city" type="text" class="w-100 @error('city') is-invalid @enderror" name="city" value="Test City" form="checkoutForm" placeholder="{{ __('text.city') }}" required autocomplete="city">
        @error('city')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>


<div class="form-group row m-0 p-0">
    <label for="postcode" class="col-md-12 col-form-label font-size-mini">{{ __('Postcode') }}<span style="color: red">*</span></label>

    <div class="col-md-12 m-0 p-0">
        <input id="postcode" type="number" class="w-100 @error('postcode') is-invalid @enderror" name="postcode" value="12345" form="checkoutForm" title="Postcode" required autocomplete="postcode">
        @error('postcode')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>


<div class="form-group row m-0 p-0">
    <label for="country" class="col-md-12 col-form-label font-size-mini">{{ __('Country') }}<span style="color: red">*</span></label>

    <div class="col-md-12 m-0 p-0">
        <select id="country" class="form-control @error('country') is-invalid @enderror" name="country" form="checkoutForm" required>
            @include('cart.partials._countries_list')
        </select>
        @error('country')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>