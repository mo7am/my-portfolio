
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

    <script src="https://unpkg.com/codethereal-iconpicker@1.2.1/dist/iconpicker.js"></script>
    @include('partials.sweetalert')
    <script>
      @php
        $datatableLang = app()->getLocale() === 'ar' ? [
            'sProcessing' => 'جاري التحميل...',
            'sLengthMenu' => 'عرض _MENU_ عنصر',
            'sZeroRecords' => 'لا توجد نتائج مطابقة',
            'sInfo' => 'عرض _START_ إلى _END_ من أصل _TOTAL_',
            'sInfoEmpty' => 'لا توجد بيانات للعرض',
            'sSearch' => 'بحث:',
            'oPaginate' => ['sFirst' => 'الأولى', 'sPrevious' => 'السابق', 'sNext' => 'التالي', 'sLast' => 'الأخيرة'],
        ] : [];
      @endphp
      window.datatableLang = @json($datatableLang);
    </script>

    @yield('scripts')

    <script>
        $(document).on('click', '.delete-confirm', function (e) {
            e.preventDefault();
            let url = $(this).data('url');
            let title = $(this).data('title') || @json(__('messages.confirm_delete'));
            let message = $(this).data('message') || @json(__('messages.cannot_undo'));
            let tableId = $(this).data('table');

            PortfolioSwal.fire({
                title: title,
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: @json(__('app.yes')),
                cancelButtonText: @json(__('app.cancel'))
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
                        PortfolioToast.fire({ icon: 'success', title: data.message || @json(__('messages.deleted', ['item' => ''])) });
                        if (tableId) $('#' + tableId).DataTable().ajax.reload(null, false);
                    })
                    .catch(() => {
                        PortfolioToast.fire({ icon: 'error', title: @json(__('messages.error')) });
                    });
                }
            });
        });
    </script>