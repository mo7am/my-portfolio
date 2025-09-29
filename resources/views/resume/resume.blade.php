@extends('resume.layouts.app')

@section('title','Resume')

@section('content')
<main class="container">
  <h1 data-aos="fade-right">Resume</h1>
  <section class="resume-section personal-info" data-aos="fade-up">
    <div class="info-wrapper">
      <div class="info-text">
        <h2>Personal Information</h2>
        <p><b>Name:</b> {{ ucwords($user->name) }}</p>
        <p><b>Email:</b> 
          <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $user->email }}" target="_blank" rel="noopener">
            {{ $user->email }}
          </a>
        </p>
        @if ($user->phone)
          <p><b>Phone:</b> 
            <a href="https://wa.me/{{ $user->phone }}" target="_blank" rel="noopener">
              {{ $user->phone }}
            </a>
          </p>    
        @endif
        @if ($user->address)
          <p><b>Address:</b> {{ $user->address }}</p>
        @endif
        @if ($user->birthdate)
          <p><b>Date of Birth:</b> {{ \Carbon\Carbon::parse($user->birthdate)->format('j F Y') }}</p>
        @endif
        @if ($user->nationality)
          <p><b>Nationality:</b> {{ $user->nationality }}</p>
        @endif
        @if ($user->marital_status)
          <p><b>Marital Status:</b> {{ $user->marital_status }}</p>
        @endif
      </div>
  
      <div class="info-photo">
        <img class="square-image" src="{{ $user->getFirstMediaUrl('logo') }}" alt="{{ ucwords($user->name) }}">
      </div>
    </div>
  </section>

  @if ($user->objective)
    <section class="resume-section" data-aos="fade-up" data-aos-delay="100">
      <h2>Objective</h2>
      <p>{{ $user->objective }}</p>
    </section>
  @endif

  @if (tenant()->is_show_experience && $experiences->count() > 0)
    <section class="resume-section" data-aos="fade-up" data-aos-delay="200">
      <div>
        <h3>Experience</h3>
        <ul class="timeline">
          @foreach ($experiences as $experience)
          <li><span class="time">{{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} – {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M Y') : 'Present' }}</span>
            <div class="content"><strong>{{ $experience->title }} {{ $experience->company }}</strong><p>{{ $experience->description }}</p></div>
          </li>
          @endforeach
        </ul>
      </div>
    </section>
  @endif

  @if (tenant()->is_show_educational && $educationals->count() > 0)
    <section class="resume-section" data-aos="fade-up" data-aos-delay="300">
      <h2>Educational Qualifications</h2>
      @foreach ($educationals as $educational)
      <p>{{ $educational->educational }} ({{ \Carbon\Carbon::parse($educational->start_date)->format('M Y') }} – {{ \Carbon\Carbon::parse($educational->end_date)->format('M Y') }})</p>
      @endforeach
    </section>
  @endif

  @if (tenant()->is_show_language && $languages->count() > 0)
    <section class="resume-section" data-aos="fade-up" data-aos-delay="400">
      <h2>Languages</h2>
      @foreach ($languages as $language)
      <p>{{ $language->language }}: {{ $language->description }}</p>
      @endforeach
    </section>
  @endif

  @if (tenant()->is_show_skill && $skills->count() > 0)
    <section class="resume-section" data-aos="fade-up" data-aos-delay="300">
      <h2>Skills</h2>
      <ul class="skills">
        @foreach ($skills as $skill)
        <li>{{ $skill->skill }}</li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_website && $websites->count() > 0)
    <section class="resume-section" data-aos="fade-up" data-aos-delay="300">
      <h2>Online Websites</h2>
      <ul>
        @foreach ($websites as $website)
          <li>{{ $website->name }} - <a href="{{ $website->url }}" target="_blank"> {{ $website->url }}</a></li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_download_cv)
      <section class="resume-section" data-aos="fade-up" data-aos-delay="400">
        <a class="btn primary" href="{{ route('portfolio.download', ['domain' => tenant()->user->domain]) }}">Download Full CV (PDF)</a>
      </section>
  @endif
  <br>
</main>
@endsection
