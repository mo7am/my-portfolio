@extends('resume.layouts.app')

@section('title', __('app.contact'))

@section('content')
<div class="container">
  <header class="page-header" data-aos="fade-right">
    <div class="section-label">{{ __('app.get_in_touch') }}</div>
    <h1>{{ __('app.contact') }}</h1>
    <p>{{ __('cv.contact_intro') }}</p>
  </header>

  <div class="contact-layout">
    <aside class="contact-aside" data-aos="fade-up">
      <h2>{{ __('cv.lets_build') }}</h2>
      <p>{{ __('cv.contact_aside') }}</p>
      <ul class="contact-points">
        <li>
          <i class="bi bi-clock"></i>
          <span>{{ __('cv.response_24h') }}</span>
        </li>
        <li>
          <i class="bi bi-chat-dots"></i>
          <span>{{ __('cv.open_to_work') }}</span>
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
        {{ __('cv.name') }}
        <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('cv.name') }}" required>
        @error('name')
          <div class="form-error">{{ $message }}</div>
        @enderror
      </label>

      <label>
        {{ __('cv.email') }}
        <input type="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
        @error('email')
          <div class="form-error">{{ $message }}</div>
        @enderror
      </label>

      <label>
        {{ __('validation.attributes.message') }}
        <textarea rows="5" name="message" placeholder="{{ __('cv.contact_aside') }}" required>{{ old('message') }}</textarea>
        @error('message')
          <div class="form-error">{{ $message }}</div>
        @enderror
      </label>

      <button class="btn primary" type="submit">
        <i class="bi bi-send"></i> {{ __('app.send_message') }}
      </button>
    </form>
  </div>
</div>
@endsection
