
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

    <!-- endbuild -->
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/pickr/pickr.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
    <script src="{{ asset('assets/js/forms-typeahead.js') }}"></script>
    <script src="{{ asset('assets/js/tables-datatables-basic.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/codethereal-iconpicker@1.2.1/dist/iconpicker.js"></script>

    

    @yield('scripts')

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                popup: 'custom-toast'
            },
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
    
        @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        @endif
        @if(session('error'))
            Toast.fire({
                icon: 'error',
                title: "{{ session('error') }}"
            });
        @endif

        $(document).on('click', '.delete-confirm', function (e) {
            e.preventDefault();

            let url   = $(this).data('url');
            let title = $(this).data('title') || 'Are you sure you want to delete this resource?';
            let message = $(this).data('message') || 'You cannot undo this action!';
            let tableId = $(this).data('table');

            Swal.fire({
                title: title,
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw Error(response.statusText);
                        return response.json();
                    })
                    .then(data => {
                        Toast.fire({
                            icon: 'success',
                            title: data.message || 'Educational deleted successfully'
                        });
                        $('#' + tableId).DataTable().ajax.reload(null, false);
                    })
                    .catch(err => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Something went wrong.'
                        });
                    });
                }
            });
        });

    </script>


    