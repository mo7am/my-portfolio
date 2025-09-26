<!doctype html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
      dir="ltr"
      data-theme="theme-default"
      data-assets-path="{{ asset('assets') }}/"
      data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta name="description" content="Work Up And Zealously Exhibit" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo/logo.png') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-misc.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    @yield('scripts')
  </body>
</html>
