@extends('layout.master')

@section('title', 'Project Groups')

@section('styles')
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Project Groups </span></h4>

    <!-- DataTable with Buttons -->
    <div class="card">
      <div class="card-datatable table-responsive pt-0">
        <table class="datatables-basic table" id="project_group_table">
          <thead>
            <tr>
              <th>Project Group</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){

  $('#project_group_table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: "{{ route('clients.project-groups.index') }}",
    },
    columns: [
          {data: 'project_work', name: 'project_work'},
          {data: null, orderable: false, searchable: false},
    ],
    columnDefs: [
      {
        targets: -1,
        title: 'Actions',
        orderable: false,
        searchable: false,
        render: function (data, type, full, meta) {
          let editUrl = "{{ route('clients.project-groups.edit', ':id') }}".replace(':id', full.id);
          let deleteUrl = "{{ route('clients.project-groups.destroy', ':id') }}".replace(':id', full.id);

          return `
            <a href="${editUrl}" 
              class="btn btn-sm btn-icon item-edit" 
              title="Edit">
              <i class="text-primary ti ti-pencil"></i>
            </a>
            <a href="javascript:;" 
              class="btn btn-sm btn-icon delete-confirm" 
              data-url="${deleteUrl}" 
              data-title="Are you sure you want to delete skill (${full.project_work}) ?" 
              data-message="You can not undo this step!" 
              data-table="project_group_table" 
              title="Delete">
              <i class="text-danger ti ti-trash"></i>
            </a>
          `;
        }
      }
    ],
    order: [[1, 'desc']],
    dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    displayLength: 7,
    lengthMenu: [7, 10, 25, 50, 75, 100],
    buttons: [
      {
        extend: 'collection',
        className: 'btn btn-label-primary dropdown-toggle me-2 waves-effect waves-light',
        text: '<i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
        buttons: [
          {
            extend: 'print',
            text: '<i class="ti ti-printer me-1" ></i>Print',
            className: 'dropdown-item',
            exportOptions: {
              columns: [0, 1]
            }
          },
          {
            extend: 'csv',
            text: '<i class="ti ti-file-text me-1" ></i>Csv',
            className: 'dropdown-item',
            exportOptions: {
              columns: [0, 1]
            }
          },
          {
            extend: 'excel',
            text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
            className: 'dropdown-item',
            exportOptions: {
              columns: [0, 1]
            }
          },
          {
            extend: 'pdf',
            text: '<i class="ti ti-file-description me-1"></i>Pdf',
            className: 'dropdown-item',
            exportOptions: {
              columns: [0, 1]
            }
          },
          {
            extend: 'copy',
            text: '<i class="ti ti-copy me-1" ></i>Copy',
            className: 'dropdown-item',
            exportOptions: {
              columns: [0, 1]
            }
          }
        ]
      },
      {
        text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Add New</span>',
        className: 'create-new btn btn-primary waves-effect waves-light',
        action: function (e, dt, node, config) {
          window.location.href = "{{ route('clients.project-groups.create') }}";
        }
      }
    ],
    responsive: {
      details: {
        display: $.fn.dataTable.Responsive.display.modal({
          header: function (row) {
            var data = row.data();
            return 'Details of ' + data['project_work'];
          }
        }),
        renderer: function (api, rowIdx, columns) {
          var data = $.map(columns, function (col, i) {
            return col.project_work !== '' 
              ? '<tr data-dt-row="' +
                  col.rowIndex +
                  '" data-dt-column="' +
                  col.columnIndex +
                  '">' +
                  '<td>' +
                  col.project_work +
                  ':' +
                  '</td> ' +
                  '<td>' +
                  col.data +
                  '</td>' +
                  '</tr>'
              : '';
          }).join('');

          return data ? $('<table class="table"/><tbody />').append(data) : false;
        }
      }
    }
  });
  $('div.head-label').html('<h5 class="card-title mb-0">Project Groups</h5>');
});
</script>
@endsection
