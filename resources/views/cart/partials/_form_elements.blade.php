<form method="POST" action="{{ route('order.store') }}" id="checkoutForm">
    @csrf
<input type="hidden" value="1" name="statuses_id">
<input type="hidden" value="1" name="customer">
<div class="d-flex">
    <div class="col-md-6 m-0 p-0">
        <label for="first_name" class="col-form-label text-md-right font-size-mini">{{ __('text.first_name') }}<span style="color: red">*</span></label>
        <input id="first_name" type="text" class="w-100 @error('first_name') is-invalid @enderror" name="first_name" value="@if(!empty($loginUser)){{$loginUser->first_name}} @else @endif" required autocomplete="first_name" autofocus>
        @error('first_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-6 m-0 p-0">
        <label for="last_name" class="col-form-label text-md-right font-size-mini">{{ __('text.last_name') }}<span style="color: red">*</span></label>
        <input id="last_name" type="text" class="w-100 @error('last_name') is-invalid @enderror" name="last_name" value="@if(!empty($loginUser)){{$loginUser->last_name}} @else @endif" required autocomplete="last_name">
        @error('last_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="d-flex">
    <div class="col-md-6 m-0 p-0">
        <label for="email" class="col-form-label text-md-right font-size-mini">{{ __('text.email') }}<span style="color: red">*</span></label>
        <input id="email" type="email" class="w-100 @error('email') is-invalid @enderror" name="email" value="@if(!empty($loginUser)){{$loginUser->email}} @else @endif" required autocomplete="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
        @enderror
    </div>

    <div class="col-md-6 m-0 p-0">
        <label for="telephone" class="col-form-label text-md-right font-size-mini">{{ __('text.telephone') }}<span style="color: red">*</span></label>
        <input id="telephone" type="text" class="w-100 @error('telephone') is-invalid @enderror" name="telephone" value="@if(!empty($loginUser)){{$loginUser->telephone}} @else @endif" required autocomplete="telephone">
        @error('telephone')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
        @enderror
    </div>
</div>

<div class="form-group row m-0 p-0">
    <label for="address" class="col-md-12 col-form-label font-size-mini">{{ __('text.address') }}<span style="color: red">*</span></label>

    <div class="col-md-12 m-0 p-0">
        <input id="address" type="text" class="w-100 @error('address') is-invalid @enderror" name="address" value="" placeholder="{{ __('text.address') }}" required autocomplete="address">
        @error('address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
</form>