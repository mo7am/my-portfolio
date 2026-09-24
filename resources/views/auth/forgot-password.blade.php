@extends('auth.layouts.master')
@section('title', __('auth.forgot'))
@section('auth_tag', __('auth.forgot'))
@section('content')
<p class="auth-intro">{{ __('auth.forgot_intro') }}</p>

@if (session('status'))
    <div class="mb-4" style="color:#16a34a;font-weight:600;text-align:center;font-size:0.92rem;">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('auth.email') }}</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="{{ __('auth.email') }}" autofocus autocomplete="username" />
        @error('email')
            <div class="invalid-feedback text-sm">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary auth-submit">{{ __('auth.send_reset_link') }}</button>

    <p class="auth-footer-note">
        <a href="{{ route('login') }}">{{ __('auth.login') }}</a>
    </p>
</form>
@endsection
