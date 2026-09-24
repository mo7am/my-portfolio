@extends('layout.master')
@section('title', __('dashboard.landing_testimonials'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.landing_testimonials'), 'description' => __('dashboard.intros.landing_testimonials')])
  <div class="card">
    <div class="card-datatable table-responsive pt-0">
      <table class="datatables-basic table w-100" id="landing_testimonial_table">
        <thead>
          <tr>
            <th>{{ __('dashboard.sort_order') }}</th>
            <th>{{ __('dashboard.name') }}</th>
            <th>{{ __('dashboard.role') }}</th>
            <th>{{ __('dashboard.published') }}</th>
            <th>{{ __('app.actions') }}</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function(){
  $('#landing_testimonial_table').DataTable({
    processing: true, serverSide: true, responsive: true,
    ajax: { url: "{{ route('admins.landing.testimonials.index') }}" },
    order: [[0, 'asc']],
    columns: [
      {data: 'sort_order', name: 'sort_order'},
      {data: 'name', name: 'name'},
      {data: 'role', name: 'role', defaultContent: ''},
      {data: 'is_published', name: 'is_published'},
      {data: null, orderable: false, searchable: false},
    ],
    columnDefs: [{
      targets: -1,
      render: function (data, type, full) {
        let editUrl = "{{ route('admins.landing.testimonials.edit', ':id') }}".replace(':id', full.id);
        let deleteUrl = "{{ route('admins.landing.testimonials.destroy', ':id') }}".replace(':id', full.id);
        return `<a href="${editUrl}" class="btn btn-sm btn-icon"><i class="text-primary ti ti-pencil"></i></a>
          <a href="javascript:;" class="btn btn-sm btn-icon delete-confirm" data-url="${deleteUrl}" data-title="{{ __('messages.confirm_delete') }}" data-message="{{ __('messages.cannot_undo') }}" data-table="landing_testimonial_table"><i class="text-danger ti ti-trash"></i></a>`;
      }
    }],
    language: window.datatableLang || {},
    dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    displayLength: 10, lengthMenu: [7, 10, 25, 50, 100],
    buttons: [{
      text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">{{ __("app.add_new") }}</span>',
      className: 'create-new btn btn-primary',
      action: function () { window.location.href = "{{ route('admins.landing.testimonials.create') }}"; }
    }]
  });
  $('div.head-label').html('<h5 class="card-title mb-0">{{ __("dashboard.landing_testimonials") }}</h5>');
});
</script>
@endsection
