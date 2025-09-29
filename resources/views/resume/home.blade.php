@extends('resume.layouts.app')

@section('title','Home')

@section('content')
<section class="hero" data-aos="fade-up">
  <div class="hero-text">
    <h1 class="name-class">{{ ucwords($user->name) }}</h1>
    <p class="subtitle">{{ ucwords($user->job_title) }}</p>
    <p class="lead">{{ $user->job_description }}</p>
    <div class="cta">
      @if (tenant()->is_show_project && $projects->count() > 0)
        <a href="{{ route('portfolio.projects', ['domain' => tenant()->user->domain]) }}" class="btn primary">View Projects</a>
      @endif
      <a href="{{ route('portfolio.resume', ['domain' => tenant()->user->domain]) }}" class="btn">View Resume</a>
    </div>
  </div>
  <div class="hero-visual" aria-hidden="true">
    <svg xmlns="http://www.w3.org/2000/svg" width="480" height="360" viewBox="0 0 480 360">
      <defs>
        <clipPath id="circleMask">
          <circle cx="150" cy="160" r="80"/>
        </clipPath>
      </defs>
      <rect width="100%" height="100%" fill="#0b0f17"/>
      @if($user->getFirstMediaUrl('logo'))
        <image 
          href="{{ $user->getFirstMediaUrl('logo') }}" 
          x="70" y="80" 
          width="160" height="160" 
          clip-path="url(#circleMask)" 
          preserveAspectRatio="xMidYMid slice"
        />
      @else
        <circle cx="150" cy="160" r="80" fill="url(#g)" opacity="0.25"/>
      @endif
      <rect x="220" y="90" width="200" height="160" rx="16" fill="#121826" stroke="rgba(255,255,255,0.08)"/>
      <circle cx="320" cy="140" r="26" fill="#182236"/>
      <rect x="260" y="190" width="120" height="12" rx="6" fill="#182236"/>
      <rect x="240" y="210" width="160" height="12" rx="6" fill="#182236"/>
    
      <text x="40" y="300" font-size="18" fill="#aab1c3" font-family="Inter, Arial, sans-serif">
        @if(tenant()->user->job_title) 
          {{ ucwords(tenant()->user->first_name) }} {{ ucwords(tenant()->user->second_name) }} — {{ ucwords(tenant()->user->job_title) }} 
        @endif
      </text>
    </svg>
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
