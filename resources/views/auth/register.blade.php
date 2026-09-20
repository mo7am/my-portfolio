@extends('auth.layouts.master')
@section('title', __('auth.register'))
@section('content')
<p class="mb-4">{{ __('auth.sign_up_title') }}</p>
<form id="formAuthentication1" class="mb-3" method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label for="first_name" class="form-label">{{ __('auth.name') }}</label>
        <input type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" id="first_name" name="first_name" placeholder="{{ __('auth.name') }}" autofocus autocomplete="given-name" />
        @error('first_name')
            <div class="invalid-feedback text-sm">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="second_name" class="form-label">{{ __('auth.second_name') }}</label>
        <input type="text" class="form-control @error('second_name') is-invalid @enderror" value="{{ old('second_name') }}" id="second_name" name="second_name" placeholder="{{ __('auth.second_name') }}" autocomplete="family-name" />
        @error('second_name')
            <div class="invalid-feedback text-sm">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('auth.email') }}</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="{{ __('auth.email') }}" autocomplete="username" />
        @error('email')
            <div class="invalid-feedback text-sm">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 form-password-toggle">
        <label class="form-label" for="password">{{ __('auth.password_label') }}</label>
        <div class="input-group input-group-merge">
            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autocomplete="new-password" />
            @error('password')
                <div class="invalid-feedback text-sm">{{ $message }}</div>
            @enderror
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
        </div>
    </div>
    <div class="mb-3 form-password-toggle">
        <label class="form-label" for="password_confirmation">{{ __('auth.confirm_password') }}</label>
        <div class="input-group input-group-merge">
            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autocomplete="new-password" />
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
        </div>
    </div>

    <button type="submit" class="btn btn-primary d-grid w-100 mb-3">{{ __('auth.sign_up') }}</button>

    <p class="text-center mb-0">
        <span>{{ __('auth.already_registered') }}</span>
        <a href="{{ route('login') }}">{{ __('auth.login') }}</a>
    </p>
</form>
@endsection
