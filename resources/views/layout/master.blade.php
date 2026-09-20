<!doctype html>
<html
  lang="{{ app()->getLocale() }}"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets') }}/"
  data-template="vertical-menu-template{{ app()->getLocale() === 'ar' ? '-rtl' : '' }}">
  @include('layout.head')
  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="{{ auth('sanctum')->user()?->type === \App\Enums\UserType::ADMIN->value ? route('admins.index') : route('clients.index') }}" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img style="width: 100px;height: 30px;" src="{{ asset('assets/logo/logo.png') }}" alt="Logo">
              </span>
              <span class="app-brand-text demo menu-text fw-bold">{{ __('app.portfolio') }}</span>
            </a>
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
              <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
          </div>
          <div class="menu-inner-shadow"></div>
          @include('layout.sidebar')
        </aside>
        <div class="layout-page">
          @include('layout.navbar')
          <div class="content-wrapper">
            @yield('content')
            @include('layout.footer')
            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>
      <div class="layout-overlay layout-menu-toggle"></div>
      <div class="drag-target"></div>
    </div>
    @include('layout.scripts')
  </body>
</html>
