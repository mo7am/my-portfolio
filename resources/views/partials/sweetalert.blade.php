<link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}">
<style>
  .swal2-container { z-index: 20000 !important; }
  body.swal2-toast-shown .swal2-container.es-swal-toast-container,
  .swal2-container.es-swal-toast-container {
    background: transparent !important;
    inset: auto !important;
    top: 1rem !important;
    left: 1rem !important;
    right: auto !important;
    bottom: auto !important;
    width: auto !important;
    height: auto !important;
    max-width: min(22rem, calc(100vw - 2rem));
    overflow: visible !important;
    pointer-events: none;
  }
  [dir="rtl"] body.swal2-toast-shown .swal2-container.es-swal-toast-container,
  [dir="rtl"] .swal2-container.es-swal-toast-container {
    left: auto !important;
    right: 1rem !important;
  }
  .es-swal-toast-container .swal2-popup.es-swal-toast {
    pointer-events: auto;
    width: auto !important;
    max-width: 22rem;
    min-height: 0 !important;
    margin: 0 !important;
    font-family: 'Tajawal', 'Public Sans', sans-serif !important;
    box-shadow: 0 0.25rem 1rem rgba(75, 70, 92, 0.2);
  }
  .es-swal-toast .swal2-title {
    margin: 0.35em 0.75em !important;
    padding: 0 !important;
    font-size: 0.9375rem !important;
    line-height: 1.4 !important;
    color: #5d596c !important;
  }
  .es-swal-toast .swal2-html-container,
  .es-swal-toast .swal2-actions,
  .es-swal-toast .swal2-footer,
  .es-swal-toast .swal2-close {
    display: none !important;
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  window.PortfolioSwal = Swal.mixin({
    buttonsStyling: false,
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-label-danger ms-1',
      denyButton: 'btn btn-label-secondary'
    }
  });
  window.PortfolioToast = Swal.mixin({
    toast: true,
    position: document.documentElement.getAttribute('dir') === 'rtl' ? 'top-end' : 'top-start',
    showConfirmButton: false,
    timer: 3200,
    timerProgressBar: true,
    customClass: {
      container: 'es-swal-toast-container',
      popup: 'es-swal-toast'
    }
  });
  @if(session('success'))
    PortfolioToast.fire({ icon: 'success', title: @json(session('success')) });
  @endif
  @if(session('error'))
    PortfolioToast.fire({ icon: 'error', title: @json(session('error')) });
  @endif
</script>
