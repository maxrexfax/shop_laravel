<form id="partialLogin" method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group row">
        <label for="email" class="col-md-10 col-form-label text-md-right">{{ __('text.e_mail_address') }}</label>

        <div class="col-md-12">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-10 col-form-label text-md-right">{{ __('text.password') }}</label>

        <div class="col-md-12">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('text.remember_me') }}
                </label>
            </div>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary" form="partialLogin">
                {{ __('text.login') }}
            </button>

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('text.forgot_your_password') }}
                </a>
            @endif
        </div>
    </div>
</form>