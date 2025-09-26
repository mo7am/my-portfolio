<head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name') }} | @yield('title')</title>

      <meta name="description" content="Work Up And Zealously Exhibit" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo/logo.png') }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/pickr/pickr-themes.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-advance.css') }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <style>
      .invalid-feedback {
          color: #dc3545 !important;
          display: inline !important;
      }
      .custom-success {
          color: #4CAF50;
      }
      .custom-toast {
        z-index: 99999 !important;
      }
      .layout-navbar-fixed body:not(.modal-open) .layout-content-navbar .layout-navbar, .layout-menu-fixed body:not(.modal-open) .layout-content-navbar .layout-navbar, .layout-menu-fixed-offcanvas body:not(.modal-open) .layout-content-navbar .layout-navbar {
        z-index: 20 !important;
      }

      .was-validated :invalid ~ .invalid-feedback,
        .was-validated :invalid ~ .invalid-tooltip,
        .is-invalid ~ .invalid-feedback,
        .is-invalid ~ .invalid-tooltip {
          display: block;
        }

        .was-validated .form-control:invalid, .form-control.is-invalid {
          border-color: #dc3545;
          padding-right: calc(1.6em + 0.75rem);
          background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
          background-repeat: no-repeat;
          background-position: right calc(0.4em + 0.1875rem) center;
          background-size: calc(0.8em + 0.375rem) calc(0.8em + 0.375rem);
        }
        .was-validated .form-control:invalid:focus, .form-control.is-invalid:focus {
          border-color: #dc3545;
          box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }

        .was-validated textarea.form-control:invalid, textarea.form-control.is-invalid {
          padding-right: calc(1.6em + 0.75rem);
          background-position: top calc(0.4em + 0.1875rem) right calc(0.4em + 0.1875rem);
        }

        .was-validated .form-select:invalid, .form-select.is-invalid {
          border-color: #dc3545;
        }
        .was-validated .form-select:invalid:not([multiple]):not([size]), .was-validated .form-select:invalid:not([multiple])[size="1"], .form-select.is-invalid:not([multiple]):not([size]), .form-select.is-invalid:not([multiple])[size="1"] {
          padding-right: 4.125rem;
          background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e"), url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
          background-position: right 0.75rem center, center right 2.25rem;
          background-size: 16px 12px, calc(0.8em + 0.375rem) calc(0.8em + 0.375rem);
        }
        .was-validated .form-select:invalid:focus, .form-select.is-invalid:focus {
          border-color: #dc3545;
          box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }

        .was-validated .form-check-input:invalid, .form-check-input.is-invalid {
          border-color: #dc3545;
        }
        .was-validated .form-check-input:invalid:checked, .form-check-input.is-invalid:checked {
          background-color: #dc3545;
        }
        .was-validated .form-check-input:invalid:focus, .form-check-input.is-invalid:focus {
          box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }
        .was-validated .form-check-input:invalid ~ .form-check-label, .form-check-input.is-invalid ~ .form-check-label {
          color: #dc3545;
        }

        .form-check-inline .form-check-input ~ .invalid-feedback {
          margin-left: 0.5em;
        }

        .was-validated .input-group .form-control:invalid, .input-group .form-control.is-invalid,
        .was-validated .input-group .form-select:invalid,
        .input-group .form-select.is-invalid {
          z-index: 2;
        }
        .was-validated .input-group .form-control:invalid:focus, .input-group .form-control.is-invalid:focus,
        .was-validated .input-group .form-select:invalid:focus,
        .input-group .form-select.is-invalid:focus {
          z-index: 3;
        }
  </style>

  </head>