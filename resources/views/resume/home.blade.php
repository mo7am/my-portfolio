@extends('resume.layouts.app')

@section('title','Home')

@section('content')
<section class="hero" data-aos="fade-up">
  <div class="hero-text">
    <h1>{{ $user->name }}</h1>
    <p class="subtitle">{{ $user->job_title }}</p>
    <p class="lead">{{ $user->job_description }}</p>
    <div class="cta">
      @if (tenant()->is_show_project && $projects->count() > 0)
        <a href="{{ route('portfolio.projects', ['domain' => tenant()->user->domain]) }}" class="btn primary">View Projects</a>
      @endif
      <a href="{{ route('portfolio.resume', ['domain' => tenant()->user->domain]) }}" class="btn">View Resume</a>
    </div>
  </div>
  <div class="hero-visual" aria-hidden="true">
    <img src="/assets/img/profile.svg" alt="Profile illustration">
  </div>
</section>

<section class="cards">
  @foreach ($projects as $project)
    <article class="card" data-aos="zoom-in">
      <h3>{{ $project->title }}</h3>
      <p>{{ $project->description }}</p>
      <a href="{{ route('portfolio.projects', ['domain' => tenant()->user->domain]) }}#webprez" class="link">Read more →</a>
    </article>
  @endforeach
</section>
@endsection
