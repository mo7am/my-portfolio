@extends('resume.layouts.app')

@section('title','Contact')

@section('content')
<div class="container">
  <header class="page-header" data-aos="fade-right">
    <div class="section-label">Get in touch</div>
    <h1>Contact</h1>
    <p>Want to collaborate or have a project in mind? Reach out — I’ll reply within 24 hours.</p>
  </header>

  <div class="contact-layout">
    <aside class="contact-aside" data-aos="fade-up">
      <h2>Let’s build something</h2>
      <p>Share a short brief and the best way to reach you. I typically respond within one business day.</p>
      <ul class="contact-points">
        <li>
          <i class="bi bi-clock"></i>
          <span>Response within 24 hours</span>
        </li>
        <li>
          <i class="bi bi-chat-dots"></i>
          <span>Open to freelance, full-time, and collaboration</span>
        </li>
        @if (tenant()->user->email)
          <li>
            <i class="bi bi-envelope"></i>
            <span>
              <a href="mailto:{{ tenant()->user->email }}">{{ tenant()->user->email }}</a>
            </span>
          </li>
        @endif
      </ul>
    </aside>

    <form class="contact-form"
          data-aos="fade-up"
          data-aos-delay="80"
          method="POST"
          action="{{ route('portfolio.contacts.store', ['domain' => tenant()->user->domain]) }}">
      @csrf

      <label>
        Name
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Your name" required>
        @error('name')
          <div class="form-error">{{ $message }}</div>
        @enderror
      </label>

      <label>
        Email
        <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
        @error('email')
          <div class="form-error">{{ $message }}</div>
        @enderror
      </label>

      <label>
        Message
        <textarea rows="5" name="message" placeholder="Tell me about your project..." required>{{ old('message') }}</textarea>
        @error('message')
          <div class="form-error">{{ $message }}</div>
        @enderror
      </label>

      <button class="btn primary" type="submit">
        <i class="bi bi-send"></i> Send message
      </button>
    </form>
  </div>
</div>
@endsection
