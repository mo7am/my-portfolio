@extends('resume.layouts.app')

@section('title', __('app.projects'))

@section('content')
<div class="container">
  <header class="page-header" data-aos="fade-right">
    <div class="section-label">{{ __('app.portfolio') }}</div>
    <h1>{{ __('app.projects') }}</h1>
    <p>{{ __('cv.portfolio_intro') }}</p>
  </header>

  @forelse ($projects as $project)
    <section class="project" id="project-{{ $project->id }}" data-aos="fade-up" data-aos-delay="{{ min($loop->index * 80, 240) }}">
      <h2>{{ $project->title }}</h2>

      <ul class="meta">
        @if ($project->role)
          <li><i class="bi bi-person-badge"></i> {{ $project->role }}</li>
        @endif
        @if ($project->type)
          <li><i class="bi bi-bookmark"></i> {{ __('cv.project_type.' . $project->type) }}</li>
        @endif
        @if (!empty($project->tags))
          <li><i class="bi bi-tags"></i> {{ implode(', ', (array) $project->tags) }}</li>
        @endif
        @if ($project->date)
          <li><i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($project->date)->format('Y') }}</li>
        @endif
        @if ($project->other)
          <li><i class="bi bi-info-circle"></i> {{ $project->other }}</li>
        @endif
      </ul>

      <p>{{ $project->description }}</p>

      @if (!empty($project->tags))
        <div class="tags">
          @foreach ((array) $project->tags as $tag)
            <span>{{ trim($tag) }}</span>
          @endforeach
        </div>
      @endif

      <div class="project-actions">
        @if ($project->website_url)
          <a class="btn primary" href="{{ $project->website_url }}" target="_blank" rel="noopener">
            <i class="bi bi-box-arrow-up-right"></i> {{ __('app.live_site') }}
          </a>
        @endif
        @if ($project->source_code)
          <a class="btn" href="{{ $project->source_code }}" target="_blank" rel="noopener">
            <i class="bi bi-link-45deg"></i> {{ __('app.source') }}
          </a>
        @endif
      </div>

      @if (!$project->website_url && !$project->source_code)
        <ul class="meta">
          <li>{{ __('app.source') }}: {{ __('app.not_available') }}@if($project->other) ({{ $project->other }}) @endif</li>
          <li>{{ __('app.live_site') }}: {{ __('app.not_available') }}</li>
        </ul>
      @endif
    </section>
  @empty
    <div class="empty-state" data-aos="fade-up">
      <p>{{ __('messages.empty') }}</p>
    </div>
  @endforelse
</div>
@endsection
