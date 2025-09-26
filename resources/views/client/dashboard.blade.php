@extends('layout.master')
@section('title','Dashboard')
@section('content')

<!-- Website Analytics -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-lg-6 mb-4">
      <div
        class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg"
        id="swiper-with-pagination-cards">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="row">
              <div class="col-12">
                <h5 class="text-white mb-0 mt-2">Website Analytics</h5>
                <small>Total {{ $project_count + $experience_count + $educational_count + $project_group_count }}</small>
              </div>
              <div class="row">
                <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                  <h6 class="text-white mt-0 mt-md-3 mb-3">Traffic</h6>
                  <div class="row">
                    <div class="col-6">
                      <ul class="list-unstyled mb-0">
                        <li class="d-flex mb-4 align-items-center">
                          <p class="mb-0 fw-medium me-2 website-analytics-text-bg">{{ $project_count }}</p>
                          <p class="mb-0">Projects</p>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                          <p class="mb-0 fw-medium me-2 website-analytics-text-bg">{{ $experience_count }}</p>
                          <p class="mb-0">Experience</p>
                        </li>
                      </ul>
                    </div>
                    <div class="col-6">
                      <ul class="list-unstyled mb-0">
                        <li class="d-flex mb-4 align-items-center">
                          <p class="mb-0 fw-medium me-2 website-analytics-text-bg">{{ $project_group_count }}</p>
                          <p class="mb-0">Group</p>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                          <p class="mb-0 fw-medium me-2 website-analytics-text-bg">{{ $educational_count }}</p>
                          <p class="mb-0">Educational</p>
                          
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                  <img
                    src="{{ asset('assets/img/illustrations/card-website-analytics-1.png')}}"
                    alt="Website Analytics"
                    width="170"
                    class="card-website-analytics-img" />
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="row">
              <div class="col-12">
                <h5 class="text-white mb-0 mt-2">Website Analytics</h5>
                <small>Total {{ $language_count + $skill_count + $link_count + $website_count }}</small>
              </div>
              <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                <h6 class="text-white mt-0 mt-md-3 mb-3">Spending</h6>
                <div class="row">
                  <div class="col-6">
                    <ul class="list-unstyled mb-0">
                      <li class="d-flex mb-4 align-items-center">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg">{{ $language_count }}</p>
                        <p class="mb-0">Language</p>
                      </li>
                      <li class="d-flex align-items-center mb-2">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg">{{ $link_count }}</p>
                        <p class="mb-0">Link</p>
                      </li>
                    </ul>
                  </div>
                  <div class="col-6">
                    <ul class="list-unstyled mb-0">
                      <li class="d-flex mb-4 align-items-center">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg">{{ $skill_count }}</p>
                        <p class="mb-0">Skill</p>
                      </li>
                      <li class="d-flex align-items-center mb-2">
                        <p class="mb-0 fw-medium me-2 website-analytics-text-bg">{{ $website_count }}</p>
                        <p class="mb-0">Website</p>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                <img
                  src="{{ asset('assets/img/illustrations/card-website-analytics-2.png')}}"
                  alt="Website Analytics"
                  width="170"
                  class="card-website-analytics-img" />
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
    <!--/ Website Analytics -->

    <!-- Sales Overview -->
    <div class="col-lg-3 col-sm-6 mb-4">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <small class="d-block mb-1 text-muted">Overview</small>
            <p class="card-text text-success">+100%</p>
          </div>
          <h4 class="card-title mb-1">{{ $project_count + $project_group_count }}</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-4">
              <div class="d-flex gap-2 align-items-center mb-2">
                <span class="badge bg-label-info p-1 rounded"
                  ><i class="ti ti-shopping-cart ti-xs"></i
                ></span>
                <p class="mb-0">Projects</p>
              </div>
              <h5 class="mb-0 pt-1 text-nowrap">100%</h5>
              <small class="text-muted">{{ $project_count }}</small>
            </div>
            <div class="col-4">
              <div class="divider divider-vertical">
                <div class="divider-text">
                  <span class="badge-divider-bg bg-label-secondary">VS</span>
                </div>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                <p class="mb-0">Groups</p>
                <span class="badge bg-label-primary p-1 rounded"><i class="ti ti-link ti-xs"></i></span>
              </div>
              <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0">100%</h5>
              <small class="text-muted">{{ $project_group_count }}</small>
            </div>
          </div>
          <div class="d-flex align-items-center mt-4">
            <div class="progress w-100" style="height: 8px">
              <div
                class="progress-bar bg-info"
                style="width: 70%"
                role="progressbar"
                aria-valuenow="70"
                aria-valuemin="0"
                aria-valuemax="100"></div>
              <div
                class="progress-bar bg-primary"
                role="progressbar"
                style="width: 30%"
                aria-valuenow="30"
                aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Sales Overview -->

    <!-- Revenue Generated -->
    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
      <div class="card">
        <div class="card-body pb-0">
          <div class="card-icon">
            <span class="badge bg-label-success rounded-pill p-2">
              <i class="ti ti-credit-card ti-sm"></i>
            </span>
          </div>
          <h5 class="card-title mb-0 mt-2">{{ $experience_count }}</h5>
          <small>Experiences</small>
        </div>
        <div id="revenueGenerated"></div>
      </div>
    </div>
    <!--/ Revenue Generated -->

    <!-- Source Visit -->
    <div class="col-xl-4 col-md-6 order-2 order-lg-1 mb-4">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="card-title mb-0">
            <h5 class="mb-0">Source Visits</h5>
            <small class="text-muted">{{ $educational_count + $language_count + $skill_count + $link_count + $website_count }}</small>
          </div>
          <div class="dropdown">
            <button
              class="btn p-0"
              type="button"
              id="sourceVisits"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false">
              <i class="ti ti-dots-vertical ti-sm text-muted"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sourceVisits">
              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
              <a class="dropdown-item" href="javascript:void(0);">Download</a>
              <a class="dropdown-item" href="javascript:void(0);">View All</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <ul class="list-unstyled mb-0">
            <li class="mb-3 pb-1">
              <div class="d-flex align-items-start">
                <div class="badge bg-label-secondary p-2 me-3 rounded">
                  <i class="ti ti-shadow ti-sm"></i>
                </div>
                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Educationals</h6>
                    <small class="text-muted">All Educationals Count</small>
                  </div>
                  <div class="d-flex align-items-center">
                    <p class="mb-0">{{ $educational_count }}</p>
                    <div class="ms-3 badge bg-label-success">+100%</div>
                  </div>
                </div>
              </div>
            </li>
            <li class="mb-3 pb-1">
              <div class="d-flex align-items-start">
                <div class="badge bg-label-secondary p-2 me-3 rounded">
                  <i class="ti ti-globe ti-sm"></i>
                </div>
                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Languages</h6>
                    <small class="text-muted">All Languages Count</small>
                  </div>
                  <div class="d-flex align-items-center">
                    <p class="mb-0">{{ $language_count }}</p>
                    <div class="ms-3 badge bg-label-success">+100%</div>
                  </div>
                </div>
              </div>
            </li>
            <li class="mb-3 pb-1">
              <div class="d-flex align-items-start">
                <div class="badge bg-label-secondary p-2 me-3 rounded">
                  <i class="ti ti-mail ti-sm"></i>
                </div>
                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Skills</h6>
                    <small class="text-muted">All Skills Count</small>
                  </div>
                  <div class="d-flex align-items-center">
                    <p class="mb-0">{{ $skill_count }}</p>
                    <div class="ms-3 badge bg-label-success">+100%</div>
                  </div>
                </div>
              </div>
            </li>
            <li class="mb-3 pb-1">
              <div class="d-flex align-items-start">
                <div class="badge bg-label-secondary p-2 me-3 rounded">
                  <i class="ti ti-external-link ti-sm"></i>
                </div>
                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Links</h6>
                    <small class="text-muted">All Links Count</small>
                  </div>
                  <div class="d-flex align-items-center">
                    <p class="mb-0">{{ $link_count }}</p>
                    <div class="ms-3 badge bg-label-danger">+100%</div>
                  </div>
                </div>
              </div>
            </li>
            <li class="mb-3 pb-1">
              <div class="d-flex align-items-start">
                <div class="badge bg-label-secondary p-2 me-3 rounded">
                  <i class="ti ti-discount-2 ti-sm"></i>
                </div>
                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Websites</h6>
                    <small class="text-muted">All Websites Count</small>
                  </div>
                  <div class="d-flex align-items-center">
                    <p class="mb-0">{{ $website_count }}</p>
                    <div class="ms-3 badge bg-label-success">+100%</div>
                  </div>
                </div>
              </div>
            </li>
            <li class="mb-2">
              <div class="d-flex align-items-start">
                <div class="badge bg-label-secondary p-2 me-3 rounded">
                  <i class="ti ti-star ti-sm"></i>
                </div>
                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Other</h6>
                    <small class="text-muted">Many Sources</small>
                  </div>
                  <div class="d-flex align-items-center">
                    <p class="mb-0">0</p>
                    <div class="ms-3 badge bg-label-success">+0%</div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!--/ Source Visit -->

    <!-- Projects table -->
    <div class="col-12 col-xl-8 col-sm-12 order-1 order-lg-2 mb-4 mb-lg-0">
      <div class="card">
        <div class="card-datatable table-responsive">
          <table class="datatables-basic table" id="project_table">
            <thead>
              <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Project Group</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
  </div>
  </div>
</div>
  <!--/ Projects table -->
@endsection

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function(){

      $('#project_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('clients.projects.index') }}",
        },
        pageLength: 4,
        columns: [
              {data: 'title', name: 'title'},
              {data: 'description', name: 'description'},
              {data: 'date', name: 'date'},
              {data: 'project_group', name: 'project_group'},
              {data: null, orderable: false, searchable: false},
        ],
        columnDefs: [
          {
            targets: -1,
            title: 'Actions',
            orderable: false,
            searchable: false,
            render: function (data, type, full, meta) {
              let editUrl = "{{ route('clients.projects.edit', ':id') }}".replace(':id', full.id);
              let deleteUrl = "{{ route('clients.projects.destroy', ':id') }}".replace(':id', full.id);

              return `
                <a href="${editUrl}" 
                  class="btn btn-sm btn-icon item-edit" 
                  title="Edit">
                  <i class="text-primary ti ti-pencil"></i>
                </a>
                <a href="javascript:;" 
                  class="btn btn-sm btn-icon delete-confirm" 
                  data-url="${deleteUrl}" 
                  data-title="Are you sure you want to delete project (${full.title}) ?" 
                  data-message="You can not undo this step!" 
                  data-table="project_table" 
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
        lengthMenu: [4, 10, 25, 50, 75, 100],
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
                  columns: [0, 1, 2, 3, 4]
                }
              },
              {
                extend: 'csv',
                text: '<i class="ti ti-file-text me-1" ></i>Csv',
                className: 'dropdown-item',
                exportOptions: {
                  columns: [0, 1, 2, 3, 4]
                }
              },
              {
                extend: 'excel',
                text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
                className: 'dropdown-item',
                exportOptions: {
                  columns: [0, 1, 2, 3, 4]
                }
              },
              {
                extend: 'pdf',
                text: '<i class="ti ti-file-description me-1"></i>Pdf',
                className: 'dropdown-item',
                exportOptions: {
                  columns: [0, 1, 2, 3, 4]
                }
              },
              {
                extend: 'copy',
                text: '<i class="ti ti-copy me-1" ></i>Copy',
                className: 'dropdown-item',
                exportOptions: {
                  columns: [0, 1, 2, 3, 4]
                }
              }
            ]
          },
          {
            text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Add New</span>',
            className: 'create-new btn btn-primary waves-effect waves-light',
            action: function (e, dt, node, config) {
              window.location.href = "{{ route('clients.projects.create') }}";
            }
          }
        ],
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: function (row) {
                var data = row.data();
                return 'Details of ' + data['title'];
              }
            }),
            renderer: function (api, rowIdx, columns) {
              var data = $.map(columns, function (col, i) {
                return col.title !== '' 
                  ? '<tr data-dt-row="' +
                      col.rowIndex +
                      '" data-dt-column="' +
                      col.columnIndex +
                      '">' +
                      '<td>' +
                      col.title +
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
      $('div.head-label').html('<h5 class="card-title mb-0">Projects</h5>');
    });
  </script>
@endsection