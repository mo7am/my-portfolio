<!doctype html>
<html
  lang="{{ str_replace('_', '-', app()->getLocale()) }}"
  class="light-style layout-wide customizer-hide"
  dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets') }}/"
  data-template="vertical-menu-template">

  @include('auth.layouts.head')

  <body>
    <div class="auth-locale">
      <a href="{{ route('locale.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
      <a href="{{ route('locale.switch', 'ar') }}" class="{{ app()->getLocale() === 'ar' ? 'active' : '' }}">ع</a>
    </div>

    <div class="authentication-wrapper authentication-cover authentication-bg">
      <div class="authentication-inner row">
        <div class="d-none d-lg-flex col-lg-7 p-0">
          <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
            <img
              src="{{ asset('assets/img/illustrations/auth-login-illustration-light.png') }}"
              alt="auth-cover"
              class="img-fluid my-5 auth-illustration"
              data-app-light-img="illustrations/auth-login-illustration-light.png"
              data-app-dark-img="illustrations/auth-login-illustration-dark.png" />
            <img
              src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}"
              alt=""
              class="platform-bg"
              data-app-light-img="illustrations/bg-shape-image-light.png"
              data-app-dark-img="illustrations/bg-shape-image-dark.png" />
          </div>
        </div>

        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-3">
          <div class="w-px-400 mx-auto w-100">
            <div class="app-brand mb-4">
              <a href="{{ url('/') }}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo" style="height: 50px !important;">
                  <img style="width: 45px;height: 50px;" src="{{ asset('assets/logo/logo.png') }}" alt="Logo" width="25">
                </span>
                <h3 class="mb-1">{{ __('auth.welcome') }}</h3>
              </a>
            </div>

            @yield('content')
          </div>
        </div>
      </div>
    </div>

    @include('partials.sweetalert')
    @include('auth.layouts.scripts')
  </body>
</html>
