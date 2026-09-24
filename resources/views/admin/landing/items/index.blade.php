@extends('layout.master')
@section('title', $type->label())
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => $type->label(), 'description' => __('dashboard.intros.landing_items')])
  <div class="card">
    <div class="card-datatable table-responsive pt-0">
      <table class="datatables-basic table w-100" id="landing_item_table">
        <thead>
          <tr>
            <th>{{ __('dashboard.sort_order') }}</th>
            <th>{{ __('dashboard.title') }}</th>
            @if($type === \App\Enums\LandingItemType::Feature)
              <th>{{ __('dashboard.icon') }}</th>
            @endif
            @if($type === \App\Enums\LandingItemType::Step)
              <th>{{ __('dashboard.step_number') }}</th>
            @endif
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
  const showIcon = @json($type === \App\Enums\LandingItemType::Feature);
  const showMeta = @json($type === \App\Enums\LandingItemType::Step);
  const columns = [
    {data: 'sort_order', name: 'sort_order'},
    {data: 'title', name: 'title'},
  ];
  if (showIcon) columns.push({data: 'icon', name: 'icon', defaultContent: ''});
  if (showMeta) columns.push({data: 'meta', name: 'meta', defaultContent: ''});
  columns.push({data: 'is_published', name: 'is_published'});
  columns.push({data: null, orderable: false, searchable: false});

  $('#landing_item_table').DataTable({
    processing: true, serverSide: true, responsive: true,
    ajax: { url: "{{ route('admins.landing.items.index', $type->value) }}" },
    order: [[0, 'asc']],
    columns: columns,
    columnDefs: [{
      targets: -1,
      render: function (data, type, full) {
        let editUrl = "{{ route('admins.landing.items.edit', [$type->value, ':id']) }}".replace(':id', full.id);
        let deleteUrl = "{{ route('admins.landing.items.destroy', [$type->value, ':id']) }}".replace(':id', full.id);
        return `<a href="${editUrl}" class="btn btn-sm btn-icon"><i class="text-primary ti ti-pencil"></i></a>
          <a href="javascript:;" class="btn btn-sm btn-icon delete-confirm" data-url="${deleteUrl}" data-title="{{ __('messages.confirm_delete') }}" data-message="{{ __('messages.cannot_undo') }}" data-table="landing_item_table"><i class="text-danger ti ti-trash"></i></a>`;
      }
    }],
    language: window.datatableLang || {},
    dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    displayLength: 10, lengthMenu: [7, 10, 25, 50, 100],
    buttons: [{
      text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">{{ __("app.add_new") }}</span>',
      className: 'create-new btn btn-primary',
      action: function () { window.location.href = "{{ route('admins.landing.items.create', $type->value) }}"; }
    }]
  });
  $('div.head-label').html('<h5 class="card-title mb-0">{{ $type->label() }}</h5>');
});
</script>
@endsection
