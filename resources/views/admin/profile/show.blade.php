@extends('layout.master')
@section('title','Profile')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">User Profile /</span> Profile</h4>

  <!-- Header -->
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="user-profile-header-banner">
          <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top" style="width: -webkit-fill-available;"/>
        </div>
        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
          <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
            <img style="width: 100px;height: 100px !important;margin-top: 23px;"
              src="{{ $user->getFirstMediaUrl('logo') }}"
              alt="user image"
              class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
          </div>
          <div class="flex-grow-1 mt-3 mt-sm-5">
            <div
              class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
              <div class="user-profile-info">
                <h4>{{ $user->name }}</h4>
                <ul
                  class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                  <li class="list-inline-item d-flex gap-1">
                    <i class="ti ti-color-swatch"></i> {{ $user->type }}
                  </li>
                  <li class="list-inline-item d-flex gap-1"><i class="ti ti-map-pin"></i> {{ $user->address }}</li>
                  <li class="list-inline-item d-flex gap-1">
                    <i class="ti ti-calendar"></i> Joined {{ $user->created_at->format('F Y') }}
                  </li>
                </ul>
              </div>
              <a href="javascript:void(0)" class="btn btn-primary">
                <i class="ti ti-check me-1"></i>Connected
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Header -->

  <!-- Navbar pills -->
  <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-pills flex-column flex-sm-row mb-4">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admins.profile.show') ? 'active' : '' }}" href="{{ route('admins.profile.show') }}">
            <i class="ti-xs ti ti-user-check me-1"></i> Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admins.profile.edit') ? 'active' : '' }}" href="{{ route('admins.profile.edit') }}">
            <i class="ti-xs ti ti-users me-1"></i> Account Settings</a>
        </li>
      </ul>
    </div>
  </div>
  <!--/ Navbar pills -->

  <!-- User Profile Content -->
  @if (request()->routeIs('admins.profile.show'))
    <div class="row">
      <div class="col-xl-4 col-lg-5 col-md-5">
        <!-- About User -->
        <div class="card mb-4">
          <div class="card-body">
            <small class="card-text text-uppercase">About</small>
            <ul class="list-unstyled mb-4 mt-3">
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-user text-heading"></i
                ><span class="fw-medium mx-2 text-heading">Full Name:</span> <span>{{ \Illuminate\Support\Str::title($user->name) }}</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-check text-heading"></i
                ><span class="fw-medium mx-2 text-heading">Status:</span> <span>{{ \Illuminate\Support\Str::title($user->status) }}</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-flag text-heading"></i
                ><span class="fw-medium mx-2 text-heading">Country:</span> <span>{{ \Illuminate\Support\Str::title($user->address) }}</span>
              </li>
            </ul>
            <small class="card-text text-uppercase">Contacts</small>
            <ul class="list-unstyled mb-4 mt-3">
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-phone-call"></i><span class="fw-medium mx-2 text-heading">Contact:</span>
                <span>{{ $user->phone }}</span>
              </li>
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-mail"></i><span class="fw-medium mx-2 text-heading">Email:</span>
                <span>{{ $user->email }}</span>
              </li>
            </ul>
          </div>
        </div>
        <!--/ About User -->
        <!-- Profile Overview -->
        <div class="card mb-4">
          <div class="card-body">
            <p class="card-text text-uppercase">Overview</p>
            <ul class="list-unstyled mb-0">
              <li class="d-flex align-items-center mb-3">
                <i class="ti ti-check"></i><span class="fw-medium mx-2">Users:</span>
                <span>{{ $users_count }}</span>
              </li>
            </ul>
          </div>
        </div>
        <!--/ Profile Overview -->
      </div>
      <div class="col-xl-8 col-lg-7 col-md-7">
        <!-- Activity Timeline -->
        <div class="card card-action mb-4">
          <div class="card-header align-items-center">
            <h5 class="card-action-title mb-0">Activity Timeline</h5>
            <div class="card-action-element">
              <div class="dropdown">
                <button
                  type="button"
                  class="btn dropdown-toggle hide-arrow p-0"
                  data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <i class="ti ti-dots-vertical text-muted"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="javascript:void(0);">Share timeline</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-body pb-0">
            <ul class="timeline ms-1 mb-0" id="activity-timeline">
              @include('client.profile.partials.activity-items')
            </ul>
            @if ($activities->hasMorePages())
              <div class="text-center my-3">
                <button id="load-more-activities" 
                        class="btn btn-outline-primary" 
                        data-next-page="{{ $activities->currentPage() + 1 }}">
                  Show More
                </button>
              </div>
            @endif
          </div>
        </div>
        <!--/ Activity Timeline -->
    </div>
  @elseif (request()->routeIs('admins.profile.edit'))
    <div class="row">
      <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Profile Details</h5>
          <form method="POST" action="{{ route('admins.profile.update') }}" enctype="multipart/form-data">
            @csrf
            <!-- Account -->
            <div class="card-body">
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img
                  src="{{ $user->getFirstMediaUrl('logo') }}" style="margin-top: -37px"
                  alt="user-avatar"
                  class="d-block w-px-100 h-px-100 rounded"
                  id="uploadedAvatar" />
                <div class="button-wrapper">
                  <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                    <span class="d-none d-sm-block">Upload new photo</span>
                    <i class="ti ti-upload d-block d-sm-none"></i>
                    <input
                      name="logo"
                      type="file"
                      id="upload"
                      class="account-file-input"
                      hidden
                      accept="image/png, image/jpeg" />
                  </label>
                  <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                    <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Reset</span>
                  </button>

                  <div class="text-muted">Allowed JPG, JPEG or GIF. Max size of 2MB</div>
                </div>
              </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
              <div class="row">
                <div class="mb-3 col-md-6">
                  <label for="first_name" class="form-label">First Name</label>
                  <input class="form-control @error('first_name') is-invalid @enderror" type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" placeholder="Enter first name" />
                    @error('first_name')
                        <div class="invalid-feedback text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label for="second_name" class="form-label">Second Name</label>
                  <input class="form-control @error('second_name') is-invalid @enderror" type="text" id="second_name" name="second_name" value="{{ old('second_name', $user->second_name) }}" placeholder="Enter second name" />
                    @error('second_name')
                        <div class="invalid-feedback text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label for="third_name" class="form-label">Third Name</label>
                  <input class="form-control @error('third_name') is-invalid @enderror" type="text" id="third_name" name="third_name" value="{{ old('third_name', $user->third_name) }}" placeholder="Enter third name" />
                    @error('third_name')
                        <div class="invalid-feedback text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label for="email" class="form-label">Email</label>
                  <input class="form-control @error('email') is-invalid @enderror" type="text" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter email" />
                    @error('email')
                        <div class="invalid-feedback text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label for="phone" class="form-label">Phone</label>
                  <input class="form-control @error('phone') is-invalid @enderror" type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Enter phone" />
                    @error('phone')
                        <div class="invalid-feedback text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label for="address" class="form-label">Address</label>
                  <input class="form-control @error('address') is-invalid @enderror" type="text" id="address" name="address" value="{{ old('address', $user->address) }}" placeholder="Enter address" />
                    @error('address')
                        <div class="invalid-feedback text-sm">{{ $message }}</div>
                    @enderror
                </div>
              </div>
            </div>
            <div class="card-body">
              <button type="submit" class="btn btn-primary me-2">Save changes</button>
              <button type="reset" class="btn btn-label-secondary">Cancel</button>
            </div>
          </form>
          <!-- /Account -->
        </div>
      </div>
    </div>
  @endif
  
  <!--/ User Profile Content -->
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const loadMoreBtn = document.getElementById('load-more-activities');
    if (!loadMoreBtn) return;

    loadMoreBtn.addEventListener('click', function () {
        let nextPage = this.dataset.nextPage;
        let url = `{{ route('clients.profile.show') }}?page=${nextPage}`;

        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.text())
            .then(html => {
                document.getElementById('activity-timeline')
                    .insertAdjacentHTML('beforeend', html);

                // Update next page or remove button if no more
                if (nextPage < {{ $activities->lastPage() }}) {
                    this.dataset.nextPage = parseInt(nextPage) + 1;
                } else {
                    this.remove();
                }
            });
    });
});
</script>
@endsection