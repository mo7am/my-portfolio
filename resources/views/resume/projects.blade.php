@extends('resume.layouts.app')

@section('title','Projects')

@section('content')
<div class="container">
  <header class="page-header" data-aos="fade-right">
    <div class="section-label">Portfolio</div>
    <h1>Projects</h1>
    <p>A selection of work spanning product builds, platforms, and experiments — with the stack and links for each.</p>
  </header>

  @forelse ($projects as $project)
    <section class="project" id="project-{{ $project->id }}" data-aos="fade-up" data-aos-delay="{{ min($loop->index * 80, 240) }}">
      <h2>{{ $project->title }}</h2>

      <ul class="meta">
        @if (!empty($project->tags))
          <li><i class="bi bi-code-slash"></i> {{ implode(', ', (array) $project->tags) }}</li>
        @endif
        @if ($project->date)
          <li><i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($project->date)->format('Y') }}</li>
        @endif
        @if ($project->other)
          <li><i class="bi bi-shield-check"></i> {{ $project->other }}</li>
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
            <i class="bi bi-box-arrow-up-right"></i> Live site
          </a>
        @endif
        @if ($project->source_code)
          <a class="btn" href="{{ $project->source_code }}" target="_blank" rel="noopener">
            <i class="bi bi-github"></i> Source
          </a>
        @endif
      </div>

      @if (!$project->website_url && !$project->source_code)
        <ul class="meta">
          <li>Source Code: Not Available @if($project->other) ({{ $project->other }}) @endif</li>
          <li>Website Url: Not Available</li>
        </ul>
      @endif
    </section>
  @empty
    <div class="empty-state" data-aos="fade-up">
      <p>No projects published yet.</p>
    </div>
  @endforelse
</div>
@endsection
