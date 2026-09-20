@extends('resume.layouts.app')

@section('title', __('app.resume'))

@section('content')
<div class="container">
  <header class="page-header" data-aos="fade-right">
    <div class="section-label">{{ __('app.curriculum_vitae') }}</div>
    <h1>{{ __('app.resume') }}</h1>
    <p>{{ __('cv.resume_intro') }}</p>
  </header>

  <section class="resume-section personal-info" data-aos="fade-up">
    <div class="info-wrapper">
      <div class="info-text">
        <h2>{{ __('cv.personal_information') }}</h2>
        <div class="info-grid">
          <div class="info-row"><span class="label">{{ __('cv.name') }}</span><span class="value">{{ ucwords($user->name) }}</span></div>
          <div class="info-row"><span class="label">{{ __('cv.email') }}</span><span class="value"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></span></div>
          @if ($user->phone)
            <div class="info-row"><span class="label">{{ __('cv.phone') }}</span><span class="value"><a href="https://wa.me/{{ $user->phone }}" target="_blank" rel="noopener">{{ $user->phone }}</a></span></div>
          @endif
          @if ($user->address)
            <div class="info-row"><span class="label">{{ __('cv.address') }}</span><span class="value">{{ $user->address }}</span></div>
          @endif
          @if ($user->birthdate)
            <div class="info-row"><span class="label">{{ __('cv.date_of_birth') }}</span><span class="value">{{ \Carbon\Carbon::parse($user->birthdate)->locale(app()->getLocale())->translatedFormat('j F Y') }}</span></div>
          @endif
          @if ($user->nationality)
            <div class="info-row"><span class="label">{{ __('cv.nationality') }}</span><span class="value">{{ $user->nationality }}</span></div>
          @endif
          @if ($user->marital_status)
            <div class="info-row"><span class="label">{{ __('cv.marital_status') }}</span><span class="value">{{ marital_status_label($user->marital_status) }}</span></div>
          @endif
          @if ($user->job_title)
            <div class="info-row"><span class="label">{{ __('cv.role') }}</span><span class="value">{{ ucwords($user->job_title) }}</span></div>
          @endif
        </div>
      </div>
      @if ($user->getFirstMediaUrl('logo'))
        <div class="info-photo">
          <img
            class="square-image js-lightbox-trigger"
            src="{{ $user->getFirstMediaUrl('logo') }}"
            alt="{{ ucwords($user->name) }}"
            data-lightbox-src="{{ $user->getFirstMediaUrl('logo') }}"
            data-lightbox-alt="{{ ucwords($user->name) }}"
            role="button"
            tabindex="0"
            aria-label="{{ __('app.view_photo') }}"
          >
        </div>
      @endif
    </div>
  </section>

  @if ($user->objective)
    <section class="resume-section" data-aos="fade-up"><h2>{{ __('cv.objective') }}</h2><p class="objective-text">{{ $user->objective }}</p></section>
  @endif

  @if (tenant()->is_show_experience && $experiences->count())
    <section class="resume-section" data-aos="fade-up">
      <h2>{{ __('cv.experience') }}</h2>
      <ul class="timeline">
        @foreach ($experiences as $experience)
          <li>
            <span class="time">
              {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} –
              {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M Y') : __('app.present') }}
            </span>
            <div class="content new-content">
              <strong>{{ $experience->title }}@if($experience->company) · {{ $experience->company }}@endif</strong>
              @if($experience->location || $experience->employment_type)
                <p class="muted">{{ collect([
                  $experience->location,
                  $experience->employment_type ? __('cv.employment.' . $experience->employment_type) : null
                ])->filter()->implode(' · ') }}</p>
              @endif
              @if ($experience->description)<p>{{ $experience->description }}</p>@endif
            </div>
          </li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_educational && $educationals->count())
    <section class="resume-section" data-aos="fade-up">
      <h2>{{ __('cv.education') }}</h2>
      <ul class="education-list">
        @foreach ($educationals as $educational)
          <li>
            <span>
              <strong>{{ $educational->educational }}</strong>
              @if($educational->institution)<br>{{ $educational->institution }}@endif
              @if($educational->degree || $educational->field)
                <br>{{ collect([$educational->degree, $educational->field])->filter()->implode(' · ') }}
              @endif
            </span>
            <span class="period">
              {{ \Carbon\Carbon::parse($educational->start_date)->format('M Y') }}
              –
              {{ $educational->end_date ? \Carbon\Carbon::parse($educational->end_date)->format('M Y') : __('app.present') }}
            </span>
          </li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_certification && $certifications->count())
    <section class="resume-section" data-aos="fade-up">
      <h2>{{ __('cv.certifications') }}</h2>
      <ul class="education-list">
        @foreach ($certifications as $item)
          <li>
            <span><strong>{{ $item->title }}</strong>@if($item->issuer) — {{ $item->issuer }}@endif</span>
            <span class="period">{{ $item->issued_at ? \Carbon\Carbon::parse($item->issued_at)->format('M Y') : '' }}</span>
          </li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_course && $courses->count())
    <section class="resume-section" data-aos="fade-up">
      <h2>{{ __('cv.courses') }}</h2>
      <ul class="education-list">
        @foreach ($courses as $item)
          <li>
            <span><strong>{{ $item->title }}</strong>@if($item->provider) — {{ $item->provider }}@endif</span>
            <span class="period">
              @if($item->start_date){{ \Carbon\Carbon::parse($item->start_date)->format('M Y') }}@endif
              @if($item->end_date) – {{ \Carbon\Carbon::parse($item->end_date)->format('M Y') }}@endif
            </span>
          </li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_award && $awards->count())
    <section class="resume-section" data-aos="fade-up">
      <h2>{{ __('cv.awards') }}</h2>
      <ul class="education-list">
        @foreach ($awards as $item)
          <li>
            <span><strong>{{ $item->title }}</strong>@if($item->issuer) — {{ $item->issuer }}@endif
              @if($item->description)<br><span class="muted">{{ $item->description }}</span>@endif
            </span>
            <span class="period">{{ $item->awarded_at ? \Carbon\Carbon::parse($item->awarded_at)->format('M Y') : '' }}</span>
          </li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_volunteering && $volunteerings->count())
    <section class="resume-section" data-aos="fade-up">
      <h2>{{ __('cv.volunteering') }}</h2>
      <ul class="timeline">
        @foreach ($volunteerings as $item)
          <li>
            <span class="time">
              @if($item->start_date){{ \Carbon\Carbon::parse($item->start_date)->format('M Y') }}@endif
              @if($item->end_date) – {{ \Carbon\Carbon::parse($item->end_date)->format('M Y') }}
              @elseif($item->start_date) – {{ __('app.present') }}@endif
            </span>
            <div class="content">
              <strong>{{ $item->organization }}@if($item->role) · {{ $item->role }}@endif</strong>
              @if($item->description)<p>{{ $item->description }}</p>@endif
            </div>
          </li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_language && $languages->count())
    <section class="resume-section" data-aos="fade-up">
      <h2>{{ __('cv.languages') }}</h2>
      <ul class="language-list">
        @foreach ($languages as $language)
          <li><span>{{ $language->language }}</span><span class="level">{{ $language->description }}</span></li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_skill && $skills->count())
    <section class="resume-section" data-aos="fade-up">
      <h2>{{ __('cv.skills') }}</h2>
      <ul class="skills">
        @foreach ($skills as $skill)
          <li>
            {{ $skill->skill }}
            @if($skill->level)
              <small>({{ $skill->level }})</small>
            @endif
            @if($skill->category)
              <small>· {{ __('cv.skill_category.' . $skill->category) }}</small>
            @endif
          </li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_project && $projects->count())
    <section class="resume-section" data-aos="fade-up">
      <h2>{{ __('cv.work_samples') }}</h2>
      <ul class="education-list">
        @foreach ($projects as $project)
          <li>
            <span>
              <strong>{{ $project->title }}</strong>
              @if($project->role) — {{ $project->role }}@endif
              @if($project->description)<br><span class="muted">{{ \Illuminate\Support\Str::limit($project->description, 140) }}</span>@endif
            </span>
            <span class="period">{{ $project->date ? \Carbon\Carbon::parse($project->date)->format('Y') : '' }}</span>
          </li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_website && $websites->count())
    <section class="resume-section" data-aos="fade-up">
      <h2>{{ __('cv.online_presence') }}</h2>
      <ul class="website-list">
        @foreach ($websites as $website)
          <li><span>{{ $website->name }}</span><a href="{{ $website->url }}" target="_blank" rel="noopener">{{ $website->url }}</a></li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_reference && $references->count())
    <section class="resume-section" data-aos="fade-up">
      <h2>{{ __('cv.references') }}</h2>
      <ul class="education-list">
        @foreach ($references as $item)
          <li>
            <span>
              <strong>{{ $item->name }}</strong>
              @if($item->position || $item->company)
                — {{ collect([$item->position, $item->company])->filter()->implode(', ') }}
              @endif
              @if($item->email)<br>{{ $item->email }}@endif
              @if($item->phone)<br>{{ $item->phone }}@endif
            </span>
          </li>
        @endforeach
      </ul>
    </section>
  @endif

  @if (tenant()->is_show_download_cv)
    <section class="resume-section resume-download" data-aos="fade-up">
      <a class="btn primary" href="{{ route('portfolio.download', ['domain' => tenant()->user->domain]) }}">
        <i class="bi bi-download"></i> {{ __('app.download_cv') }}
      </a>
    </section>
  @endif
</div>
@endsection
