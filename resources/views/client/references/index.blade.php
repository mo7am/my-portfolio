@extends('layout.master')
@section('title', __('dashboard.references'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.references'), 'description' => __('dashboard.intros.reference')])
  <div class="card">
    <div class="card-datatable table-responsive pt-0">
      <table class="datatables-basic table w-100" id="reference_table">
        <thead><tr><th>{{ __('validation.attributes.name') }}</th><th>{{ __('validation.attributes.position') }}</th><th>{{ __('validation.attributes.company') }}</th><th>{{ __('app.actions') }}</th></tr></thead>
      </table>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
$(function(){
  const table = $('#reference_table').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: { url: "{{ route('clients.references.index') }}" },
    columns: [
          {data: 'name', name: 'name'},
          {data: 'position', name: 'position'},
          {data: 'company', name: 'company'},
          {data: null, orderable: false, searchable: false}
    ],
    columnDefs: [{
      targets: -1,
      render: function (data, type, full) {
        let editUrl = "{{ route('clients.references.edit', ':id') }}".replace(':id', full.id);
        let deleteUrl = "{{ route('clients.references.destroy', ':id') }}".replace(':id', full.id);
        return `<a href="${editUrl}" class="btn btn-sm btn-icon"><i class="text-primary ti ti-pencil"></i></a>
          <a href="javascript:;" class="btn btn-sm btn-icon delete-confirm" data-url="${deleteUrl}" data-title="{{ __('messages.confirm_delete') }}" data-message="{{ __('messages.cannot_undo') }}" data-table="reference_table"><i class="text-danger ti ti-trash"></i></a>`;
      }
    }],
    language: window.datatableLang || {},
    dom: '<"card-header flex-column flex-md-row"<"head-label"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    buttons: [{
      text: '<i class="ti ti-plus me-sm-1"></i> {{ __("app.add_new") }}',
      className: 'btn btn-primary',
      action: () => window.location.href = "{{ route('clients.references.create') }}"
    }]
  });
  $('div.head-label').html('<h5 class="card-title mb-0">{{ __("dashboard.references") }}</h5>');
});
</script>
@endsection
