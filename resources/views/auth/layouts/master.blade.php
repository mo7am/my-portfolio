<!doctype html>
<html
  lang="{{ str_replace('_', '-', app()->getLocale()) }}"
  class="light-style layout-wide customizer-hide auth-page"
  dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets') }}/"
  data-template="vertical-menu-template">

  @include('auth.layouts.head')

  <body class="auth-body">
    <div class="auth-shell">
      <div class="auth-locale">
        <a href="{{ route('locale.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
        <a href="{{ route('locale.switch', 'ar') }}" class="{{ app()->getLocale() === 'ar' ? 'active' : '' }}">ع</a>
      </div>

      <div class="auth-card">
        <a href="{{ route('landing') }}" class="auth-brand">
          <img class="auth-brand__logo" src="{{ asset('assets/logo/logo.png') }}" alt="{{ config('app.name') }}">
          <h1 class="auth-brand__name">{{ config('app.name') }}</h1>
          <p class="auth-brand__tag">@yield('auth_tag', __('auth.welcome'))</p>
        </a>

        @yield('content')
      </div>

      <div class="auth-back">
        <a href="{{ route('landing') }}">{{ __('auth.back_home') }}</a>
      </div>
    </div>

    @include('partials.sweetalert')
    @include('auth.layouts.scripts')
  </body>
</html>
