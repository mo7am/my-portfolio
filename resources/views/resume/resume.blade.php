@extends('resume.layouts.app')

@section('title','Resume')

@section('content')
<div class="container">
  <header class="page-header" data-aos="fade-right">
    <div class="section-label">Curriculum vitae</div>
    <h1>Resume</h1>
    <p>Background, experience, and capabilities at a glance.</p>
  </header>

  <section class="resume-section personal-info" data-aos="fade-up">
    <div class="info-wrapper">
      <div class="info-text">
        <h2>Personal information</h2>
        <div class="info-grid">
          <div class="info-row">
            <span class="label">Name</span>
            <span class="value">{{ ucwords($user->name) }}</span>
          </div>
          <div class="info-row">
            <span class="label">Email</span>
            <span class="value">
              <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $user->email }}" target="_blank" rel="noopener">
                {{ $user->email }}
              </a>
            </span>
          </div>
          @if ($user->phone)
            <div class="info-row">
              <span class="label">Phone</span>
              <span class="value">
                <a href="https://wa.me/{{ $user->phone }}" target="_blank" rel="noopener">
                  {{ $user->phone }}
                </a>
              </span>
            </div>
          @endif
          @if ($user->address)
            <div class="info-row">
              <span class="label">Address</span>
              <span class="value">{{ $user->address }}</span>
            </div>
          @endif
          @if ($user->birthdate)
            <div class="info-row">
              <span class="label">Date of birth</span>
              <span class="value">{{ \Carbon\Carbon::parse($user->birthdate)->format('j F Y') }}</span>
            </div>
          @endif
          @if ($user->nationality)
            <div class="info-row">
              <span class="label">Nationality</span>
              <span class="value">{{ $user->nationality }}</span>
            </div>
          @endif
          @if ($user->marital_status)
            <div class="info-row">
              <span class="label">Marital status</span>
              <span class="value">{{ $user->marital_status }}</span>
            </div>
          @endif
          @if ($user->job_title)
            <div class="info-row">
              <span class="label">Role</span>
              <span class="value">{{ ucwords($user->job_title) }}</span>
            </div>
          @endif
        </div>
      </div>

      @if ($user->getFirstMediaUrl('logo'))
        <div class="info-photo">
          <img class="square-image" src="{{ $user->getFirstMediaUrl('logo') }}" alt="{{ ucwords($user->name) }}">
        </div>
      @endif
    </div>
  </section>

  @if ($user->objective)
    <section class="resume-section" data-aos="fade-up" data-aos-delay="60">
      <h2>Objective</h2>
      <p class="objective-text">{{ $user->objective }}</p>
    </section>
  @endif

  @if (tenant()->is_show_experience && $experiences->count() > 0)
    <section class="resume-section" data-aos="fade-up" data-aos-delay="80">
      <h2>Experience</h2>
      <ul class="timeline">
        @foreach ($experiences as $experience)
          <li>
            <span class="time">
              {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }}
              –
              {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M Y') : 'Present' }}
            </span>
            <div class="content new-content">
              <strong>{{ $experience->title }}@if($experience->company) · {{ $experience->company }}@endif</strong>
              @if ($experience->description)
                <p>{{ $experience->description }}</p>
              @endif
            </div>
          </li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_educational && $educationals->count() > 0)
    <section class="resume-section" data-aos="fade-up" data-aos-delay="100">
      <h2>Education</h2>
      <ul class="education-list">
        @foreach ($educationals as $educational)
          <li>
            <span>{{ $educational->educational }}</span>
            <span class="period">
              {{ \Carbon\Carbon::parse($educational->start_date)->format('M Y') }}
              –
              {{ \Carbon\Carbon::parse($educational->end_date)->format('M Y') }}
            </span>
          </li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_language && $languages->count() > 0)
    <section class="resume-section" data-aos="fade-up" data-aos-delay="120">
      <h2>Languages</h2>
      <ul class="language-list">
        @foreach ($languages as $language)
          <li>
            <span>{{ $language->language }}</span>
            <span class="level">{{ $language->description }}</span>
          </li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_skill && $skills->count() > 0)
    <section class="resume-section" data-aos="fade-up" data-aos-delay="140">
      <h2>Skills</h2>
      <ul class="skills">
        @foreach ($skills as $skill)
          <li>{{ $skill->skill }}</li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_website && $websites->count() > 0)
    <section class="resume-section" data-aos="fade-up" data-aos-delay="160">
      <h2>Online presence</h2>
      <ul class="website-list">
        @foreach ($websites as $website)
          <li>
            <span>{{ $website->name }}</span>
            <a href="{{ $website->url }}" target="_blank" rel="noopener">{{ $website->url }}</a>
          </li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_download_cv)
    <section class="resume-section resume-download" data-aos="fade-up" data-aos-delay="180">
      <a class="btn primary" href="{{ route('portfolio.download', ['domain' => tenant()->user->domain]) }}">
        <i class="bi bi-download"></i> Download full CV (PDF)
      </a>
    </section>
  @endif
</div>
@endsection
