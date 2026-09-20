@extends('auth.layouts.master')
@section('title', __('auth.forgot'))
@section('content')
<div class="mb-4">
    <p class="mb-0">{{ __('auth.forgot_intro') }}</p>
</div>

@if (session('status'))
    <div class="mb-4 custom-success">
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

    <button type="submit" class="btn btn-primary d-grid w-100 mb-3">{{ __('auth.send_reset_link') }}</button>

    <p class="text-center mb-0">
        <a href="{{ route('login') }}">{{ __('auth.login') }}</a>
    </p>
</form>
@endsection
