@extends('layout.master')
@section('title', __('dashboard.project_groups'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.project_groups'), 'description' => __('dashboard.intros.project_group')])
  <div class="card">
    <div class="card-datatable table-responsive pt-0">
      <table class="datatables-basic table w-100" id="project_group_table">
        <thead>
          <tr>
              <th>{{ __('dashboard.project_group') }}</th>
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
$(function(){
  $('#project_group_table').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: { url: "{{ route('clients.project-groups.index') }}" },
    columns: [
      {data: 'project_work', name: 'project_work', defaultContent: ''},
      {data: null, orderable: false, searchable: false},
    ],
    columnDefs: [{
      targets: -1,
      render: function (data, type, full) {
        let editUrl = "{{ route('clients.project-groups.edit', ':id') }}".replace(':id', full.id);
        let deleteUrl = "{{ route('clients.project-groups.destroy', ':id') }}".replace(':id', full.id);
        return `<a href="${editUrl}" class="btn btn-sm btn-icon"><i class="text-primary ti ti-pencil"></i></a>
          <a href="javascript:;" class="btn btn-sm btn-icon delete-confirm" data-url="${deleteUrl}" data-title="{{ __('messages.confirm_delete') }}" data-message="{{ __('messages.cannot_undo') }}" data-table="project_group_table"><i class="text-danger ti ti-trash"></i></a>`;
      }
    }],
    language: window.datatableLang || {},
    dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    buttons: [{
      text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">{{ __("app.add_new") }}</span>',
      className: 'create-new btn btn-primary',
      action: function () { window.location.href = "{{ route('clients.project-groups.create') }}"; }
    }]
  });
  $('div.head-label').html('<h5 class="card-title mb-0">{{ __("dashboard.project_groups") }}</h5>');
});
</script>
@endsection