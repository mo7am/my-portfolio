<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta name="description" content="{{ config('app.name') }}" />

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo/logo.png') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    @if(app()->getLocale() === 'ar')
      <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet" />
    @else
      <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    @endif

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/form-validation.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <style>
        @if(app()->getLocale() === 'ar')
        body, .authentication-wrapper { font-family: 'Tajawal', 'Public Sans', sans-serif !important; }
        @endif
        .invalid-feedback {
            color: #dc3545 !important;
            display: inline !important;
        }
        .custom-success { color: #4CAF50; }
        .auth-locale {
            position: absolute;
            top: 1rem;
            inset-inline-end: 1rem;
            z-index: 10;
            display: flex;
            gap: 0.5rem;
        }
        .auth-locale a {
            padding: 0.25rem 0.6rem;
            border-radius: 0.375rem;
            background: rgba(255,255,255,0.9);
            color: #5d596c;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            border: 1px solid #e6e6e8;
        }
        .auth-locale a.active {
            background: #7367f0;
            color: #fff;
            border-color: #7367f0;
        }
        @media (max-width: 575.98px) {
            .authentication-wrapper .w-px-400 { max-width: 100%; }
            .app-brand h3 { font-size: 1.15rem; }
        }
        .was-validated :invalid ~ .invalid-feedback,
        .is-invalid ~ .invalid-feedback { display: block; }
        .form-control.is-invalid {
          border-color: #dc3545;
        }
    </style>
</head>
