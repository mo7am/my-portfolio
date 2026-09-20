@extends('resume.layouts.app')

@section('title', __('app.home'))

@section('content')
@php
  $logoUrl = $user->getFirstMediaUrl('logo');
  $initials = collect(explode(' ', trim($user->name)))
    ->filter()
    ->take(2)
    ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
    ->implode('');
  $projectList = collect($projects);
  $projectCount = $projectList->count();
@endphp

<section class="hero" data-aos="fade-up">
  <div class="hero-text">
    @if($user->job_title)
      <p class="subtitle">{{ ucwords($user->job_title) }}</p>
    @endif
    <h1 class="name-class">{{ ucwords($user->name) }}</h1>
    @if($user->job_description)
      <p class="lead">{{ $user->job_description }}</p>
    @endif
    <div class="cta">
      @if (tenant()->is_show_project && $projectCount > 0)
        <a href="{{ route('portfolio.projects', ['domain' => tenant()->user->domain]) }}" class="btn primary">{{ __('app.view_projects') }}</a>
      @endif
      <a href="{{ route('portfolio.resume', ['domain' => tenant()->user->domain]) }}" class="btn">{{ __('app.view_resume') }}</a>
      @if (tenant()->is_show_contact)
        <a href="{{ route('portfolio.contact', ['domain' => tenant()->user->domain]) }}" class="btn">{{ __('app.contact_me') }}</a>
      @endif
    </div>
    <div class="hero-stats">
      @if ($projectCount > 0)
        <div class="hero-stat">
          <strong>{{ $projectCount }}</strong>
          <span>{{ __('app.projects') }}</span>
        </div>
      @endif
      @if ($user->job_title)
        <div class="hero-stat">
          <strong>{{ __('app.available_for_work') }}</strong>
          <span>{{ __('app.for_new_work') }}</span>
        </div>
      @endif
    </div>
  </div>

  <div class="hero-visual" aria-hidden="true">
    <div class="hero-portrait">
      @if($logoUrl)
        <img
          class="js-lightbox-trigger"
          src="{{ $logoUrl }}"
          alt="{{ ucwords($user->name) }}"
          data-lightbox-src="{{ $logoUrl }}"
          data-lightbox-alt="{{ ucwords($user->name) }}"
          role="button"
          tabindex="0"
          aria-label="{{ __('app.view_photo') }}"
        >
      @else
        <div class="hero-portrait-fallback">{{ $initials ?: 'ME' }}</div>
      @endif
    </div>
  </div>
</section>

@if ($projectCount > 0)
  <div class="home-section-title" data-aos="fade-up">
    <div>
      <div class="section-label">{{ __('app.selected_work') }}</div>
      <h2>{{ __('app.featured_projects') }}</h2>
    </div>
    @if (tenant()->is_show_project)
      <a href="{{ route('portfolio.projects', ['domain' => tenant()->user->domain]) }}">{{ __('app.view_all') }} →</a>
    @endif
  </div>

  <section class="cards">
    @foreach ($projectList->take(6) as $project)
      <article class="card" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 60 }}">
        <h3>{{ $project->title }}</h3>
        <p>{{ $project->description }}</p>
        @if (!empty($project->tags))
          <div class="tags tags--compact">
            @foreach (array_slice((array) $project->tags, 0, 3) as $tag)
              <span>{{ trim($tag) }}</span>
            @endforeach
          </div>
        @endif
        <a href="{{ route('portfolio.projects', ['domain' => tenant()->user->domain]) }}#project-{{ $project->id }}" class="link">{{ __('app.read_more') }} →</a>
      </article>
    @endforeach
  </section>
@endif
@endsection
