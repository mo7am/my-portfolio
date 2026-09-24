@extends('layout.master')
@section('title', __('app.dashboard'))

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', [
    'title' => __('app.dashboard'),
    'description' => __('dashboard.intros.admin_dashboard'),
  ])

  <div class="row">
    <div class="col-lg-6 mb-4">
      <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg" id="swiper-with-pagination-cards">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="row">
              <div class="col-12">
                <h5 class="text-white mb-0 mt-2">{{ __('dashboard.analytics') }}</h5>
                <small>{{ config('app.name') }} · {{ $users_count + $tenants_count }}</small>
              </div>
              <div class="row">
                <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                  <h6 class="text-white mt-0 mt-md-3 mb-3">{{ __('dashboard.users') }}</h6>
                  <div class="row">
                    <div class="col-6">
                      <ul class="list-unstyled mb-0">
                        <li class="d-flex mb-4 align-items-center">
                          <p class="mb-0 fw-medium me-2 website-analytics-text-bg">{{ $users_count }}</p>
                          <p class="mb-0">{{ __('dashboard.clients') }}</p>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                          <p class="mb-0 fw-medium me-2 website-analytics-text-bg">{{ $admins_count }}</p>
                          <p class="mb-0">{{ __('dashboard.admins') }}</p>
                        </li>
                      </ul>
                    </div>
                    <div class="col-6">
                      <ul class="list-unstyled mb-0">
                        <li class="d-flex mb-4 align-items-center">
                          <p class="mb-0 fw-medium me-2 website-analytics-text-bg">{{ $tenants_count }}</p>
                          <p class="mb-0">{{ __('dashboard.tenants') }}</p>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                          <p class="mb-0 fw-medium me-2 website-analytics-text-bg">{{ $activities_count }}</p>
                          <p class="mb-0">{{ __('app.activity') }}</p>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                  <img
                    src="{{ asset('assets/img/illustrations/card-website-analytics-1.png') }}"
                    alt=""
                    width="170"
                    class="card-website-analytics-img" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-2">
            <small class="text-muted">{{ __('dashboard.clients') }}</small>
            <span class="badge bg-label-primary">{{ __('dashboard.users') }}</span>
          </div>
          <h3 class="mb-1">{{ $users_count }}</h3>
          <p class="mb-3 text-muted small">{{ __('dashboard.intros.users') }}</p>
          <a href="{{ route('admins.users.index') }}" class="btn btn-sm btn-primary">
            {{ __('dashboard.view_all_users') }}
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-2">
            <small class="text-muted">{{ __('dashboard.tenants') }}</small>
            <span class="badge bg-label-success">{{ config('app.name') }}</span>
          </div>
          <h3 class="mb-1">{{ $tenants_count }}</h3>
          <div class="d-flex justify-content-between align-items-center mt-3">
            <span class="text-muted small">{{ __('dashboard.admins') }}</span>
            <strong>{{ $admins_count }}</strong>
          </div>
          <div class="progress mt-2" style="height: 6px;">
            <div class="progress-bar bg-primary" style="width: {{ $tenants_count > 0 ? min(100, ($users_count / max($tenants_count, 1)) * 100) : 0 }}%"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 mb-4">
      <div class="card">
        <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
          <div>
            <h5 class="mb-0">{{ __('dashboard.recent_signups') }}</h5>
            <small class="text-muted">{{ __('dashboard.clients') }}</small>
          </div>
          <a href="{{ route('admins.users.create') }}" class="btn btn-primary btn-sm">
            <i class="ti ti-plus me-1"></i>{{ __('app.add_new') }}
          </a>
        </div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th>{{ __('app.photo_preview') }}</th>
                <th>{{ __('auth.name') }}</th>
                <th>{{ __('auth.email') }}</th>
                <th>{{ __('dashboard.portfolio_link') }}</th>
                <th>{{ __('app.joined') }}</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($recent_users as $recent)
                <tr>
                  <td>
                    @php $logo = $recent->getFirstMediaUrl('logo'); @endphp
                    @if($logo)
                      <img src="{{ $logo }}" alt="" width="40" height="40" class="rounded-circle object-fit-cover" style="object-fit:cover;">
                    @else
                      <span class="avatar avatar-sm bg-label-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                        {{ mb_strtoupper(mb_substr($recent->first_name ?? 'U', 0, 1)) }}
                      </span>
                    @endif
                  </td>
                  <td class="fw-medium">{{ $recent->name }}</td>
                  <td>{{ $recent->email }}</td>
                  <td>
                    @if($recent->domain)
                      <a href="{{ $recent->portfolio_link }}" target="_blank" rel="noopener">{{ $recent->domain }}</a>
                    @else
                      —
                    @endif
                  </td>
                  <td>{{ optional($recent->created_at)->translatedFormat('M Y') }}</td>
                  <td class="text-end">
                    <a href="{{ route('admins.users.edit', $recent->id) }}" class="btn btn-sm btn-icon" title="{{ __('app.edit') }}">
                      <i class="ti ti-pencil text-primary"></i>
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center text-muted py-4">{{ __('dashboard.no_users_yet') }}</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        @if($recent_users->isNotEmpty())
          <div class="card-footer bg-transparent text-center">
            <a href="{{ route('admins.users.index') }}">{{ __('dashboard.view_all_users') }} →</a>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
