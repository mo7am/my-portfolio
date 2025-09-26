@extends('auth.layouts.master')
@section('title','Reset Password')
@section('content')
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" value="{{ old('email', $request->email) }}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" autofocus />
            @error('email')
                <div class="invalid-feedback text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
            @error('password')
                <div class="invalid-feedback text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
            @error('password_confirmation')
                <div class="invalid-feedback text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="btn btn-primary d-grid w-100">Reset Password</button>
        </div>
    </form>
@endsection
