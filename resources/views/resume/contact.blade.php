@extends('resume.layouts.app')

@section('title','Contact')

@section('content')
<main class="container">
  <h1 data-aos="fade-right">Contact</h1>
  <p data-aos="fade-up">Want to collaborate or have a project in mind? Reach out—I'll reply within 24 hours.</p>

  <form class="contact-form" 
        data-aos="fade-up" 
        data-aos-delay="100" 
        method="POST" 
        action="{{ route('portfolio.contacts.store', ['domain' => tenant()->user->domain]) }}">
    @csrf

    <label>
      Name
      <input type="text" name="name" value="{{ old('name') }}" placeholder="Your name">
      @error('name')
        <div class="text-red-500 text-sm">{{ $message }}</div>
      @enderror
    </label>

    <label>
      Email
      <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com">
      @error('email')
        <div class="text-red-500 text-sm">{{ $message }}</div>
      @enderror
    </label>

    <label>
      Message
      <textarea rows="5" name="message" placeholder="Tell me about your project...">{{ old('message') }}</textarea>
      @error('message')
        <div class="text-red-500 text-sm">{{ $message }}</div>
      @enderror
    </label>

    <button class="btn primary" type="submit">Send</button>
  </form>
</main>
@endsection
