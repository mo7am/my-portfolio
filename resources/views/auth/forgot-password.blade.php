@extends('auth.layouts.master')
@section('title','Forgot Password')
@section('content')
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 custom-success">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email')  is-invalid @enderror" value="{{old('email')}}" id="email" name="email" placeholder="Enter your email" autofocus />
            @error('email')
                <div class="invalid-feedback text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="btn btn-primary d-grid w-100">Email Password Reset Link</button>
        </div>
    </form>
@endsection
