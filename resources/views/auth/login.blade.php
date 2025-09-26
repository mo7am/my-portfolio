{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('auth.layouts.master')
@section('title','Login')
@section('content')
<p class="mb-4">Please sign-in to Portfolio and start the adventure</p>
    <form id="formAuthentication1" class="mb-3" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" autofocus />
            @error('email')
                <div class="invalid-feedback text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 form-password-toggle">
        <div class="d-flex justify-content-between">
            <label class="form-label" for="password">Password</label>
            <a href="{{ route('password.request') }}">
            <small>Forgot Password?</small>
            </a>
        </div>
        <div class="input-group input-group-merge">
            <input
            type="password"
            id="password"
            class="form-control @error('password') is-invalid @enderror"
            name="password"
            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
            aria-describedby="password" />
            @error('password')
                <div class="invalid-feedback text-sm">{{ $message }}</div>
            @enderror
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
        </div>
        </div>
        <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember-me" />
            <label class="form-check-label" for="remember-me"> Remember Me </label>
        </div>
        </div>
        <button type="submit" class="btn btn-primary d-grid w-100">Sign in</button>
    </form>

    <p class="text-center">
        <span>New on our platform?</span>
        <a href="{{ route('register') }}">
        <span>Create an account</span>
        </a>
    </p>

    <div class="divider my-4">
        <div class="divider-text">or</div>
    </div>

    <div class="d-flex justify-content-center">
        <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
        <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
        </a>

        <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
        <i class="tf-icons fa-brands fa-google fs-5"></i>
        </a>

        <a href="javascript:;" class="btn btn-icon btn-label-twitter">
        <i class="tf-icons fa-brands fa-twitter fs-5"></i>
        </a>
    </div>
@endsection
