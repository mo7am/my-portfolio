@extends('auth.layouts.master')
@section('title', __('auth.reset_password'))
@section('content')
<form method="POST" action="{{ route('password.store') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('auth.email') }}</label>
        <input type="email" value="{{ old('email', $request->email) }}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{ __('auth.email') }}" autofocus autocomplete="username" />
        @error('email')
            <div class="invalid-feedback text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 form-password-toggle">
        <label for="password" class="form-label">{{ __('auth.password_label') }}</label>
        <div class="input-group input-group-merge">
            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autocomplete="new-password" />
            @error('password')
                <div class="invalid-feedback text-sm">{{ $message }}</div>
            @enderror
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
        </div>
    </div>

    <div class="mb-3 form-password-toggle">
        <label for="password_confirmation" class="form-label">{{ __('auth.confirm_password') }}</label>
        <div class="input-group input-group-merge">
            <input type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autocomplete="new-password" />
            @error('password_confirmation')
                <div class="invalid-feedback text-sm">{{ $message }}</div>
            @enderror
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
        </div>
    </div>

    <button type="submit" class="btn btn-primary d-grid w-100">{{ __('auth.reset_password') }}</button>
</form>
@endsection