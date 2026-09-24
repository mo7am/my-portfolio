@extends('layout.master')
@section('title', __('dashboard.landing_settings'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.landing_settings'), 'description' => __('dashboard.intros.landing_settings')])

  <div class="card mb-4">
    <div class="card-header"><h5 class="mb-0">{{ __('dashboard.landing_hero') }}</h5></div>
    <div class="card-body">
      <form method="POST" action="{{ route('admins.landing.settings.update') }}">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="mb-3 col-md-6">
            <label class="form-label">{{ __('dashboard.hero_eyebrow') }}</label>
            <input class="form-control @error('hero_eyebrow') is-invalid @enderror" type="text" name="hero_eyebrow" value="{{ old('hero_eyebrow', $settings->hero_eyebrow) }}">
            @error('hero_eyebrow')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">{{ __('dashboard.hero_title') }}</label>
            <input class="form-control @error('hero_title') is-invalid @enderror" type="text" name="hero_title" value="{{ old('hero_title', $settings->hero_title) }}">
            @error('hero_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3 col-12">
            <label class="form-label">{{ __('dashboard.hero_subtitle') }}</label>
            <textarea class="form-control @error('hero_subtitle') is-invalid @enderror" name="hero_subtitle" rows="3">{{ old('hero_subtitle', $settings->hero_subtitle) }}</textarea>
            @error('hero_subtitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">{{ __('dashboard.hero_cta_primary') }}</label>
            <input class="form-control @error('hero_cta_primary') is-invalid @enderror" type="text" name="hero_cta_primary" value="{{ old('hero_cta_primary', $settings->hero_cta_primary) }}">
            @error('hero_cta_primary')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">{{ __('dashboard.hero_cta_secondary') }}</label>
            <input class="form-control @error('hero_cta_secondary') is-invalid @enderror" type="text" name="hero_cta_secondary" value="{{ old('hero_cta_secondary', $settings->hero_cta_secondary) }}">
            @error('hero_cta_secondary')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        <hr class="my-4">
        <h6 class="mb-3">{{ __('dashboard.landing_final_cta') }}</h6>
        <div class="row">
          <div class="mb-3 col-md-6">
            <label class="form-label">{{ __('dashboard.final_cta_title') }}</label>
            <input class="form-control @error('final_cta_title') is-invalid @enderror" type="text" name="final_cta_title" value="{{ old('final_cta_title', $settings->final_cta_title) }}">
            @error('final_cta_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">{{ __('dashboard.footer_tagline') }}</label>
            <input class="form-control @error('footer_tagline') is-invalid @enderror" type="text" name="footer_tagline" value="{{ old('footer_tagline', $settings->footer_tagline) }}">
            @error('footer_tagline')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3 col-12">
            <label class="form-label">{{ __('dashboard.final_cta_subtitle') }}</label>
            <textarea class="form-control @error('final_cta_subtitle') is-invalid @enderror" name="final_cta_subtitle" rows="2">{{ old('final_cta_subtitle', $settings->final_cta_subtitle) }}</textarea>
            @error('final_cta_subtitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">{{ __('dashboard.final_cta_primary') }}</label>
            <input class="form-control @error('final_cta_primary') is-invalid @enderror" type="text" name="final_cta_primary" value="{{ old('final_cta_primary', $settings->final_cta_primary) }}">
            @error('final_cta_primary')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">{{ __('dashboard.final_cta_secondary') }}</label>
            <input class="form-control @error('final_cta_secondary') is-invalid @enderror" type="text" name="final_cta_secondary" value="{{ old('final_cta_secondary', $settings->final_cta_secondary) }}">
            @error('final_cta_secondary')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        <hr class="my-4">
        <h6 class="mb-3">{{ __('dashboard.landing_announcement') }}</h6>
        <div class="row">
          <div class="mb-3 col-md-8">
            <label class="form-label">{{ __('dashboard.announcement_text') }}</label>
            <input class="form-control @error('announcement_text') is-invalid @enderror" type="text" name="announcement_text" value="{{ old('announcement_text', $settings->announcement_text) }}">
            @error('announcement_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3 col-md-4">
            <label class="form-label">{{ __('dashboard.announcement_url') }}</label>
            <input class="form-control @error('announcement_url') is-invalid @enderror" type="text" name="announcement_url" value="{{ old('announcement_url', $settings->announcement_url) }}">
            @error('announcement_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3 col-12">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="announcement_enabled" value="1" id="announcement_enabled" @checked(old('announcement_enabled', $settings->announcement_enabled))>
              <label class="form-check-label" for="announcement_enabled">{{ __('dashboard.announcement_enabled') }}</label>
            </div>
          </div>
        </div>

        <hr class="my-4">
        <h6 class="mb-3">{{ __('dashboard.landing_contact') }}</h6>
        <div class="row">
          <div class="mb-3 col-md-6">
            <label class="form-label">{{ __('dashboard.contact_email') }}</label>
            <input class="form-control @error('contact_email') is-invalid @enderror" type="email" name="contact_email" value="{{ old('contact_email', $settings->contact_email) }}">
            @error('contact_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">{{ __('dashboard.contact_phone') }}</label>
            <input class="form-control @error('contact_phone') is-invalid @enderror" type="text" name="contact_phone" value="{{ old('contact_phone', $settings->contact_phone) }}">
            @error('contact_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        <hr class="my-4">
        <h6 class="mb-3">{{ __('dashboard.landing_social') }}</h6>
        <div class="row">
          <div class="mb-3 col-md-6">
            <label class="form-label">Twitter / X</label>
            <input class="form-control @error('social_twitter') is-invalid @enderror" type="url" name="social_twitter" value="{{ old('social_twitter', $settings->social_twitter) }}">
            @error('social_twitter')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">LinkedIn</label>
            <input class="form-control @error('social_linkedin') is-invalid @enderror" type="url" name="social_linkedin" value="{{ old('social_linkedin', $settings->social_linkedin) }}">
            @error('social_linkedin')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">GitHub</label>
            <input class="form-control @error('social_github') is-invalid @enderror" type="url" name="social_github" value="{{ old('social_github', $settings->social_github) }}">
            @error('social_github')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">Facebook</label>
            <input class="form-control @error('social_facebook') is-invalid @enderror" type="url" name="social_facebook" value="{{ old('social_facebook', $settings->social_facebook) }}">
            @error('social_facebook')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        <button type="submit" class="btn btn-primary mt-2">{{ __('app.save') }}</button>
        <a href="{{ route('landing', ['preview' => 1]) }}" target="_blank" class="btn btn-label-secondary mt-2">{{ __('dashboard.view_landing') }}</a>
      </form>
    </div>
  </div>
</div>
@endsection
