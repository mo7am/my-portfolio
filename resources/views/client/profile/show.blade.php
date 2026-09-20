@extends('layout.master')
@section('title', __('app.profile'))

@section('styles')
<style>
  .profile-hero {
    position: relative;
    border-radius: 0.75rem;
    overflow: hidden;
    background: linear-gradient(135deg, #5a8dee 0%, #7367f0 48%, #28c76f 100%);
    min-height: 150px;
    margin-bottom: 1.5rem;
  }
  .profile-hero-body {
    position: relative;
    z-index: 1;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 1.25rem;
    padding: 1.5rem;
  }
  .profile-avatar {
    width: 96px;
    height: 96px;
    object-fit: cover;
    border-radius: 1rem;
    border: 4px solid #fff;
    box-shadow: 0 8px 24px rgba(34, 41, 47, 0.18);
    background: #fff;
  }
  .profile-avatar-fallback {
    display: grid;
    place-items: center;
    font-weight: 700;
    font-size: 1.6rem;
    color: #7367f0;
    background: #fff;
  }
  .profile-meta h3 {
    color: #fff !important;
    margin: 0 0 .4rem;
    font-weight: 700;
  }
  .profile-meta .chips {
    display: flex;
    flex-wrap: wrap;
    gap: .45rem;
  }
  .profile-meta .chip {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    padding: .3rem .7rem;
    border-radius: 999px;
    background: rgba(255,255,255,.18);
    color: #fff;
    font-size: .8125rem;
  }
  .profile-actions {
    margin-inline-start: auto;
    display: flex;
    flex-wrap: wrap;
    gap: .5rem;
  }
  .profile-actions .btn-light {
    background: #fff;
    border-color: #fff;
    color: #5d596c;
  }
  .profile-card .label-muted {
    font-size: .75rem;
    letter-spacing: .04em;
    text-transform: uppercase;
    color: #a5a3ae;
    font-weight: 600;
  }
  .profile-list li {
    display: flex;
    gap: .75rem;
    align-items: flex-start;
    padding: .65rem 0;
    border-bottom: 1px solid rgba(75,70,92,.08);
  }
  .profile-list li:last-child { border-bottom: 0; }
  .profile-list .ico {
    width: 2rem;
    height: 2rem;
    border-radius: .5rem;
    display: grid;
    place-items: center;
    background: rgba(115, 103, 240, .08);
    color: #7367f0;
    flex-shrink: 0;
  }
  .profile-photo-panel {
    display: flex;
    flex-wrap: wrap;
    gap: 1.25rem;
    align-items: center;
  }
  .profile-photo-panel img,
  .profile-photo-panel .profile-avatar-fallback {
    width: 120px;
    height: 120px;
    border-radius: 1rem;
    object-fit: cover;
    border: 1px solid rgba(75,70,92,.12);
  }
  .stat-pill {
    border-radius: .75rem;
    background: rgba(115, 103, 240, .06);
    padding: .9rem 1rem;
  }
  .stat-pill strong {
    display: block;
    font-size: 1.35rem;
    line-height: 1.2;
  }
  .profile-edit-card .card-header {
    background: transparent;
  }
  @media (max-width: 575.98px) {
    .profile-actions { margin-inline-start: 0; width: 100%; }
    .profile-actions .btn { flex: 1; }
  }
</style>
@endsection

@section('content')
@php
  $logoUrl = $user->getFirstMediaUrl('logo');
  $hasLogo = (bool) $user->getFirstMedia('logo');
  $initials = collect(explode(' ', trim($user->name)))
    ->filter()
    ->take(2)
    ->map(fn ($p) => mb_strtoupper(mb_substr($p, 0, 1)))
    ->implode('');
  $isEdit = request()->routeIs('clients.profile.edit');
@endphp

<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', [
    'title' => $isEdit ? __('app.account_settings') : __('app.profile'),
    'description' => __('dashboard.intros.profile'),
  ])

  <div class="profile-hero">
    <div class="profile-hero-body">
      @if($hasLogo)
        <img class="profile-avatar" src="{{ $logoUrl }}" alt="{{ $user->name }}">
      @else
        <div class="profile-avatar profile-avatar-fallback">{{ $initials ?: 'ME' }}</div>
      @endif

      <div class="profile-meta">
        <h3>{{ ucwords($user->name) }}</h3>
        <div class="chips">
          @if($user->job_title)
            <span class="chip"><i class="ti ti-briefcase"></i> {{ $user->job_title }}</span>
          @endif
          @if($user->address)
            <span class="chip"><i class="ti ti-map-pin"></i> {{ $user->address }}</span>
          @endif
          <span class="chip"><i class="ti ti-calendar"></i> {{ __('app.joined') }} {{ $user->created_at->translatedFormat('F Y') }}</span>
        </div>
      </div>

      <div class="profile-actions">
        <a class="btn btn-light" href="{{ $user->portfolio_link }}" target="_blank" rel="noopener">
          <i class="ti ti-external-link me-1"></i>{{ __('app.open_portfolio') }}
        </a>
        @unless($isEdit)
          <a class="btn btn-primary" href="{{ route('clients.profile.edit') }}">
            <i class="ti ti-edit me-1"></i>{{ __('app.account_settings') }}
          </a>
        @endunless
      </div>
    </div>
  </div>

  <ul class="nav nav-pills flex-column flex-sm-row mb-4 gap-1">
    <li class="nav-item">
      <a class="nav-link {{ ! $isEdit ? 'active' : '' }}" href="{{ route('clients.profile.show') }}">
        <i class="ti ti-user-check me-1"></i> {{ __('app.profile') }}
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ $isEdit ? 'active' : '' }}" href="{{ route('clients.profile.edit') }}">
        <i class="ti ti-settings me-1"></i> {{ __('app.account_settings') }}
      </a>
    </li>
  </ul>

  @if (! $isEdit)
    <div class="row">
      <div class="col-xl-4 col-lg-5 mb-4">
        <div class="card profile-card mb-4">
          <div class="card-body">
            <div class="label-muted mb-3">{{ __('app.about') }}</div>
            <ul class="list-unstyled profile-list mb-0">
              <li>
                <span class="ico"><i class="ti ti-user"></i></span>
                <div>
                  <div class="text-muted small">{{ __('app.full_name') }}</div>
                  <div class="fw-medium">{{ \Illuminate\Support\Str::title($user->name) }}</div>
                </div>
              </li>
              <li>
                <span class="ico"><i class="ti ti-briefcase"></i></span>
                <div>
                  <div class="text-muted small">{{ __('dashboard.professional_title') }}</div>
                  <div class="fw-medium">{{ $user->job_title ?: '—' }}</div>
                </div>
              </li>
              <li>
                <span class="ico"><i class="ti ti-flag"></i></span>
                <div>
                  <div class="text-muted small">{{ __('cv.nationality') }}</div>
                  <div class="fw-medium">{{ $user->nationality ?: '—' }}</div>
                </div>
              </li>
              <li>
                <span class="ico"><i class="ti ti-map-pin"></i></span>
                <div>
                  <div class="text-muted small">{{ __('cv.address') }}</div>
                  <div class="fw-medium">{{ $user->address ?: '—' }}</div>
                </div>
              </li>
            </ul>
          </div>
        </div>

        <div class="card profile-card mb-4">
          <div class="card-body">
            <div class="label-muted mb-3">{{ __('app.contacts') }}</div>
            <ul class="list-unstyled profile-list mb-0">
              <li>
                <span class="ico"><i class="ti ti-mail"></i></span>
                <div>
                  <div class="text-muted small">{{ __('cv.email') }}</div>
                  <div class="fw-medium text-break">{{ $user->email }}</div>
                </div>
              </li>
              <li>
                <span class="ico"><i class="ti ti-phone"></i></span>
                <div>
                  <div class="text-muted small">{{ __('cv.phone') }}</div>
                  <div class="fw-medium">{{ $user->phone ?: '—' }}</div>
                </div>
              </li>
            </ul>
          </div>
        </div>

        <div class="card profile-card">
          <div class="card-body">
            <div class="label-muted mb-3">{{ __('app.overview') }}</div>
            <div class="row g-3">
              <div class="col-6">
                <div class="stat-pill">
                  <strong>{{ $tenant->projects_count }}</strong>
                  <span class="text-muted small">{{ __('dashboard.projects') }}</span>
                </div>
              </div>
              <div class="col-6">
                <div class="stat-pill">
                  <strong>{{ $tenant->languages_count }}</strong>
                  <span class="text-muted small">{{ __('dashboard.languages') }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-8 col-lg-7 mb-4">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">{{ __('app.activity') }}</h5>
          </div>
          <div class="card-body pb-0">
            <ul class="timeline ms-1 mb-0" id="activity-timeline">
              @include('client.profile.partials.activity-items')
            </ul>
            @if ($activities->hasMorePages())
              <div class="text-center my-3">
                <button id="load-more-activities" class="btn btn-outline-primary" data-next-page="{{ $activities->currentPage() + 1 }}">
                  {{ __('app.show_more') }}
                </button>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  @else
    <div class="row">
      <div class="col-12">
        <div class="card profile-edit-card mb-4">
          <div class="card-header border-bottom">
            <h5 class="mb-1">{{ __('app.profile_details') }}</h5>
            <p class="mb-0 text-muted small">{{ __('dashboard.intros.profile') }}</p>
          </div>

          @if ($errors->any())
            <div class="alert alert-danger mx-4 mt-4 mb-0">
              <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('clients.profile.update') }}" enctype="multipart/form-data" id="profile-form">
            @csrf

            <div class="card-body">
              <div class="profile-photo-panel">
                @if($hasLogo)
                  <img src="{{ $logoUrl }}" alt="{{ __('app.photo_preview') }}" id="uploadedAvatar">
                @else
                  <div class="profile-avatar-fallback" id="uploadedAvatarFallback">{{ $initials ?: 'ME' }}</div>
                  <img src="" alt="{{ __('app.photo_preview') }}" id="uploadedAvatar" class="d-none">
                @endif
                <div>
                  <label for="upload" class="btn btn-primary me-2 mb-2">
                    <i class="ti ti-camera me-1"></i>
                    <span>{{ $hasLogo ? __('app.change_photo') : __('app.upload_photo') }}</span>
                    <input name="logo" type="file" id="upload" hidden accept="image/png,image/jpeg,image/jpg,image/webp,image/gif">
                  </label>
                  <button type="button" class="btn btn-label-secondary mb-2" id="reset-photo" @disabled(! $hasLogo)>
                    {{ __('app.cancel') }}
                  </button>
                  <div class="text-muted small">{{ __('app.photo_hint') }}</div>
                  @error('logo')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            <hr class="my-0">

            <div class="card-body">
              <div class="row g-3">
                <div class="col-md-4">
                  <label for="first_name" class="form-label">{{ __('auth.name') }}</label>
                  <input class="form-control @error('first_name') is-invalid @enderror" type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}">
                  @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                  <label for="second_name" class="form-label">{{ __('auth.second_name') }}</label>
                  <input class="form-control @error('second_name') is-invalid @enderror" type="text" id="second_name" name="second_name" value="{{ old('second_name', $user->second_name) }}">
                  @error('second_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                  <label for="third_name" class="form-label">{{ __('validation.attributes.third_name') }}</label>
                  <input class="form-control @error('third_name') is-invalid @enderror" type="text" id="third_name" name="third_name" value="{{ old('third_name', $user->third_name) }}">
                  @error('third_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                  <label for="email" class="form-label">{{ __('cv.email') }}</label>
                  <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
                  @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                  <label for="phone" class="form-label">{{ __('cv.phone') }}</label>
                  <input class="form-control @error('phone') is-invalid @enderror" type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                  @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                  <label for="address" class="form-label">{{ __('cv.address') }}</label>
                  <input class="form-control @error('address') is-invalid @enderror" type="text" id="address" name="address" value="{{ old('address', $user->address) }}">
                  @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                  <label for="nationality" class="form-label">{{ __('cv.nationality') }}</label>
                  <input class="form-control @error('nationality') is-invalid @enderror" type="text" id="nationality" name="nationality" value="{{ old('nationality', $user->nationality) }}">
                  @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="marital_status">{{ __('cv.marital_status') }}</label>
                  <select name="marital_status" id="marital_status" class="select2 form-select @error('marital_status') is-invalid @enderror">
                    <option value="">—</option>
                    <option value="Single" @selected(old('marital_status', $user->marital_status) === 'Single')>Single</option>
                    <option value="Married" @selected(old('marital_status', $user->marital_status) === 'Married')>Married</option>
                  </select>
                  @error('marital_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                  <label for="birthdate" class="form-label">{{ __('cv.date_of_birth') }}</label>
                  <input class="form-control @error('birthdate') is-invalid @enderror" type="date" id="birthdate" name="birthdate" value="{{ old('birthdate', optional($user->birthdate)->format('Y-m-d')) }}">
                  @error('birthdate')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                  <label for="domain" class="form-label">{{ __('validation.attributes.domain') }}</label>
                  <div class="input-group">
                    <span class="input-group-text">{{ rtrim(config('app.url'), '/') }}/</span>
                    <input type="text" class="form-control @error('domain') is-invalid @enderror" id="domain" name="domain" value="{{ old('domain', $user->domain) }}">
                  </div>
                  @error('domain')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                  <label for="objective" class="form-label">{{ __('cv.objective') }}</label>
                  <textarea class="form-control @error('objective') is-invalid @enderror" id="objective" name="objective" rows="3">{{ old('objective', $user->objective) }}</textarea>
                  @error('objective')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                  <label for="job_title" class="form-label">{{ __('dashboard.professional_title') }}</label>
                  <input class="form-control @error('job_title') is-invalid @enderror" type="text" id="job_title" name="job_title" value="{{ old('job_title', $user->job_title) }}">
                  @error('job_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                  <label for="job_description" class="form-label">{{ __('dashboard.professional_summary') }}</label>
                  <textarea class="form-control @error('job_description') is-invalid @enderror" id="job_description" name="job_description" rows="3">{{ old('job_description', $user->job_description) }}</textarea>
                  @error('job_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
              </div>
            </div>

            <div class="card-footer bg-transparent border-top d-flex flex-wrap gap-2">
              <button type="submit" class="btn btn-primary">{{ __('app.save_changes') }}</button>
              <a href="{{ route('clients.profile.show') }}" class="btn btn-label-secondary">{{ __('app.cancel') }}</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  @endif
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const fileInput = document.getElementById('upload');
  const preview = document.getElementById('uploadedAvatar');
  const fallback = document.getElementById('uploadedAvatarFallback');
  const resetBtn = document.getElementById('reset-photo');
  const originalSrc = preview && !preview.classList.contains('d-none') ? preview.src : '';

  if (fileInput && preview) {
    fileInput.addEventListener('change', function () {
      const file = this.files && this.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = function (e) {
        preview.src = e.target.result;
        preview.classList.remove('d-none');
        if (fallback) fallback.classList.add('d-none');
        if (resetBtn) resetBtn.disabled = false;
      };
      reader.readAsDataURL(file);
    });
  }

  if (resetBtn) {
    resetBtn.addEventListener('click', function () {
      if (fileInput) fileInput.value = '';
      if (originalSrc) {
        preview.src = originalSrc;
        preview.classList.remove('d-none');
        if (fallback) fallback.classList.add('d-none');
      } else {
        preview.src = '';
        preview.classList.add('d-none');
        if (fallback) fallback.classList.remove('d-none');
        resetBtn.disabled = true;
      }
    });
  }

  const loadMoreBtn = document.getElementById('load-more-activities');
  if (!loadMoreBtn) return;

  loadMoreBtn.addEventListener('click', function () {
    const nextPage = this.dataset.nextPage;
    fetch(`{{ route('clients.profile.show') }}?page=${nextPage}`, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(response => response.text())
      .then(html => {
        document.getElementById('activity-timeline').insertAdjacentHTML('beforeend', html);
        if (nextPage < {{ $activities->lastPage() }}) {
          this.dataset.nextPage = parseInt(nextPage, 10) + 1;
        } else {
          this.remove();
        }
      });
  });
});
</script>
@endsection
