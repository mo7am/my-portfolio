@extends('layout.master')

@section('title', __('dashboard.experiences'))

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @include('partials.page-intro', ['title' => __('dashboard.experiences'), 'description' => __('dashboard.intros.experience')])

    <div class="card">
      <div class="card-datatable table-responsive pt-0">
        <table class="datatables-basic table w-100" id="experience_table">
          <thead>
            <tr>
              <th>{{ __('validation.attributes.title') }}</th>
              <th>{{ __('app.company') }}</th>
              <th>{{ __('app.location') }}</th>
              <th>{{ __('validation.attributes.start_date') }}</th>
              <th>{{ __('validation.attributes.end_date') }}</th>
              <th>{{ __('app.actions') }}</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
  $('#experience_table').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: { url: "{{ route('clients.experiences.index') }}" },
    columns: [
      {data: 'title', name: 'title'},
      {data: 'company', name: 'company', defaultContent: ''},
      {data: 'location', name: 'location', defaultContent: ''},
      {data: 'start_date', name: 'start_date'},
      {data: 'end_date', name: 'end_date'},
      {data: null, orderable: false, searchable: false},
    ],
    columnDefs: [{
      targets: -1,
      render: function (data, type, full) {
        let editUrl = "{{ route('clients.experiences.edit', ':id') }}".replace(':id', full.id);
        let deleteUrl = "{{ route('clients.experiences.destroy', ':id') }}".replace(':id', full.id);
        return `<a href="${editUrl}" class="btn btn-sm btn-icon" title="{{ __('app.edit') }}"><i class="text-primary ti ti-pencil"></i></a>
          <a href="javascript:;" class="btn btn-sm btn-icon delete-confirm" data-url="${deleteUrl}" data-title="{{ __('messages.confirm_delete') }}" data-message="{{ __('messages.cannot_undo') }}" data-table="experience_table" title="{{ __('app.delete') }}"><i class="text-danger ti ti-trash"></i></a>`;
      }
    }],
    order: [[3, 'desc']],
    language: window.datatableLang || {},
    dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    displayLength: 10,
    lengthMenu: [7, 10, 25, 50, 100],
    buttons: [
      {
        extend: 'collection',
        className: 'btn btn-label-primary dropdown-toggle me-2 waves-effect waves-light',
        text: '<i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">{{ __("app.export") }}</span>',
        buttons: [
          { extend: 'print', text: 'Print', className: 'dropdown-item', exportOptions: { columns: [0,1,2,3,4] } },
          { extend: 'csv', text: 'Csv', className: 'dropdown-item', exportOptions: { columns: [0,1,2,3,4] } },
          { extend: 'excel', text: 'Excel', className: 'dropdown-item', exportOptions: { columns: [0,1,2,3,4] } },
          { extend: 'pdf', text: 'Pdf', className: 'dropdown-item', exportOptions: { columns: [0,1,2,3,4] } },
          { extend: 'copy', text: 'Copy', className: 'dropdown-item', exportOptions: { columns: [0,1,2,3,4] } }
        ]
      },
      {
        text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">{{ __("app.add_new") }}</span>',
        className: 'create-new btn btn-primary waves-effect waves-light',
        action: function () { window.location.href = "{{ route('clients.experiences.create') }}"; }
      }
    ]
  });
  $('div.head-label').html('<h5 class="card-title mb-0">{{ __("dashboard.experiences") }}</h5>');
});
</script>
@endsection
