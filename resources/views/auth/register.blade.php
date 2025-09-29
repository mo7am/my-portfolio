@extends('auth.layouts.master')
@section('title','Register')
@section('content')
    <p class="mb-4">Please sign-up to Portfolio and start the adventure</p>
    <form id="formAuthentication1" class="mb-3" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name')}}" id="first_name" name="first_name" placeholder="Enter first name" autofocus />
            @error('first_name')
                <div class="invalid-feedback text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="second_name" class="form-label">Second Name</label>
            <input type="text" class="form-control @error('second_name') is-invalid @enderror" value="{{old('second_name')}}" id="second_name" name="second_name" placeholder="Enter second name" autofocus />
            @error('second_name')
                <div class="invalid-feedback text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" id="email" name="email" placeholder="Enter your email" autofocus />
            @error('email')
                <div class="invalid-feedback text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-group input-group-merge">
            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
            @error('password')
                <div class="invalid-feedback text-sm">{{ $message }}</div>
            @enderror           
        </div>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
        <br>
        <button type="submit" class="btn btn-primary d-grid w-100">Sign up</button>
    </form>
@endsection
