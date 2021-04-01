<div class="pay-method-details-1">
    <div class="form-group row m-0 p-0">
        <label for="selectCardType" class="col-md-12 col-form-label font-size-mini">{{ __('text.choice_card_type') }}<span style="color: red">*</span></label>

        <div class="col-md-12 m-0 p-0">
            <select id="selectCardType" type="text" class="form-control w-100 @error('city') is-invalid @enderror" name="card_type" value="" form="checkoutForm" required>
                <option value="0"> </option>
                <option value="1">First option</option>
                <option value="2">Second option</option>
            </select>
            @error('city')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row m-0 p-0">
        <label for="creditCardNumber" class="col-md-12 col-form-label font-size-mini">{{ __('text.credit_card_number') }}<span style="color: red">*</span></label>

        <div class="col-md-12 m-0 p-0">
            <input id="creditCardNumber" type="text" class="w-100 @error('credit_card_number') is-invalid @enderror" name="credit_card_number" form="checkoutForm" placeholder="{{ __('text.credit_card_number') }}" required>
            @error('city')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="d-flex">
        <div class="col-md-9 m-0 p-0">
            <label for="expirationYear" class="col-form-label text-md-right font-size-mini">{{ __('text.expire_date') }}<span style="color: red">*</span></label>
            <select id="expirationYear" type="text" class="form-control w-100 @error('expiration_year') is-invalid @enderror" name="expiration_year" form="checkoutForm" required>
                <option value="0"> </option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
            </select>
            @error('expiration_year')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-3 m-0 p-0">
            <label for="" class="col-form-label text-md-right font-size-mini"><span style="color: red">*</span></label>
            <select id="expirationMonth" type="text" class="form-control w-100 @error('expiration_month') is-invalid @enderror" name="expiration_month" form="checkoutForm" required>
                <option value="0"> </option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            @error('expiration_month')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="d-flex">
        <div class="col-md-6 m-0 p-0">
            <label for="creditCardVerificationNumber" class="col-form-label text-md-right font-size-mini">{{ __('text.card_verification_number') }}<span style="color: red">*</span></label>
            <input id="creditCardVerificationNumber" type="text" class="w-100 @error('card_verification_number') is-invalid @enderror" name="card_verification_number" form="checkoutForm" placeholder="{{ __('CVV') }}" required>
            @error('first_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-6 m-0 p-0">
            <label>&nbsp;</label>
            <p class="font-size-mini text-right"><a href="#">What is this?</a></p>
        </div>
    </div>
</div>