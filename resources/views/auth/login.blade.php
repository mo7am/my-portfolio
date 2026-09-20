@extends('auth.layouts.master')
@section('title', __('auth.login'))
@section('content')
<p class="mb-4">{{ __('auth.sign_in_title') }}</p>
<form id="formAuthentication1" class="mb-3" action="{{ route('login') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('auth.email') }}</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('auth.email') }}" autofocus autocomplete="username" />
        @error('email')
            <div class="invalid-feedback text-sm">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 form-password-toggle">
        <div class="d-flex justify-content-between">
            <label class="form-label" for="password">{{ __('auth.password_label') }}</label>
            <a href="{{ route('password.request') }}">
                <small>{{ __('auth.forgot') }}</small>
            </a>
        </div>
        <div class="input-group input-group-merge">
            <input
                type="password"
                id="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                autocomplete="current-password"
                aria-describedby="password" />
            @error('password')
                <div class="invalid-feedback text-sm">{{ $message }}</div>
            @enderror
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
        </div>
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember-me" name="remember" value="1" @checked(old('remember')) />
            <label class="form-check-label" for="remember-me">{{ __('auth.remember') }}</label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary d-grid w-100">{{ __('auth.sign_in') }}</button>
</form>

<p class="text-center">
    <span>{{ __('app.new_on_platform') }}</span>
    <a href="{{ route('register') }}">
        <span>{{ __('app.create_account') }}</span>
    </a>
</p>
@endsection
