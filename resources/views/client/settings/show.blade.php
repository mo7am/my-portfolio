@extends('layout.master')
@section('title', __('dashboard.settings'))
@section('content')
@php
  $switches = [
    'is_show_educational' => __('dashboard.educationals'),
    'is_show_experience' => __('dashboard.experiences'),
    'is_show_language' => __('dashboard.languages'),
    'is_show_skill' => __('dashboard.skills'),
    'is_show_project' => __('dashboard.projects'),
    'is_show_website' => __('dashboard.websites'),
    'is_show_link' => __('dashboard.links'),
    'is_show_certification' => __('dashboard.certifications'),
    'is_show_course' => __('dashboard.courses'),
    'is_show_award' => __('dashboard.awards'),
    'is_show_volunteering' => __('dashboard.volunteerings'),
    'is_show_reference' => __('dashboard.references'),
    'is_show_contact' => __('app.contact'),
    'is_show_download_cv' => __('app.download_cv'),
  ];
@endphp
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.settings'), 'description' => __('dashboard.intros.settings')])
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('clients.settings.update') }}">
        @csrf
        <h6 class="mb-3">{{ __('dashboard.visibility') }}</h6>
        <div class="row">
          @foreach($switches as $field => $label)
            <div class="col-md-6 mb-3">
              <label class="switch">
                <input type="hidden" name="{{ $field }}" value="0">
                <input type="checkbox" class="switch-input" name="{{ $field }}" value="1" @checked(old($field, $tenant->{$field}))>
                <span class="switch-toggle-slider"><span class="switch-on"><i class="ti ti-check"></i></span><span class="switch-off"><i class="ti ti-x"></i></span></span>
                <span class="switch-label">{{ $label }}</span>
              </label>
            </div>
          @endforeach
        </div>
        <button type="submit" class="btn btn-primary mt-2">{{ __('app.save') }}</button>
      </form>
    </div>
  </div>
</div>
@endsection
