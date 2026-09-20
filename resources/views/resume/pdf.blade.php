<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="UTF-8">
  <title>{{ __('app.resume') }}</title>
  <style>
    @page { margin: 0; }

    body {
      font-family: {{ app()->getLocale() === 'ar' ? '"DejaVu Sans"' : '"DejaVu Sans", sans-serif' }};
      font-size: 12pt;
      margin: 20px;
      height: 100%;
      direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }};
      text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};
    }

    .outer-border {
      border: 6px solid #000;
      padding: 6px;
      height: 100%;
      box-sizing: border-box;
    }

    .inner-border {
      border: 1px solid #000;
      padding: 20px;
      height: 100%;
      box-sizing: border-box;
    }

    h1 {
      text-align: center;
      font-size: 20pt;
      margin: 0;
    }

    h2 {
      font-size: 17pt;
      margin-top: 20px;
      padding-bottom: 5px;
    }

    .header-table {
      width: 100%;
      margin: 20px 0;
      border-collapse: collapse;
    }

    .header-table td {
      vertical-align: top;
      padding: 5px;
    }

    .header-left { width: 70%; }
    .header-left p { margin: 4px 0; }

    .header-right {
      width: 30%;
      text-align: {{ app()->getLocale() === 'ar' ? 'left' : 'right' }};
    }

    .header-right img {
      width: 180px;
      height: 165px;
      object-fit: cover;
      margin-top: -10px;
      border: 2px solid #555;
      border-radius: 10px;
      padding: 3px;
      background: #f9f9f9;
    }

    .two-col {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 15px;
    }

    .two-col td {
      vertical-align: top;
      padding: 3px;
    }

    .two-col .left { width: 70%; }
    .two-col .right {
      width: 30%;
      text-align: {{ app()->getLocale() === 'ar' ? 'left' : 'right' }};
      padding-top: 30px;
      padding-right: 50px;
    }

    ul { margin: 5px 0 5px 20px; padding: 0; }
    li { margin-bottom: 3px; }
    p { line-height: 1.4; }
  </style>
</head>
<body>
  <div class="outer-border">
    <div class="inner-border">

      <h1 style="font-size: 30px">{{ __('app.resume') }}</h1>
      <h2 style="text-align:center; border:0; margin-top:5px;text-decoration: underline;font-size:23px">{{ ucwords($user->name) }}</h2>
      @if($user->job_title)
        <h4 style="text-align:center; border:0;font-size:16px; margin-top:-20px">{{ ucwords($user->job_title) }}</h4>
      @endif

      <table class="header-table">
        <tr>
          <td class="header-left">
            <p><b>{{ __('cv.email') }}:</b>
              <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
            </p>
            @if ($user->phone)
              <p><b>{{ __('cv.phone') }}:</b>
                <a href="https://wa.me/{{ $user->phone }}">{{ $user->phone }}</a>
              </p>
            @endif
            @if ($user->address)
              <p><b>{{ __('cv.address') }}:</b> {{ $user->address }}</p>
            @endif
            @if ($user->birthdate)
              <p><b>{{ __('cv.date_of_birth') }}:</b> {{ \Carbon\Carbon::parse($user->birthdate)->translatedFormat('j F Y') }}</p>
            @endif
            @if ($user->nationality)
              <p><b>{{ __('cv.nationality') }}:</b> {{ $user->nationality }}</p>
            @endif
            @if ($user->marital_status)
              <p><b>{{ __('cv.marital_status') }}:</b> {{ $user->marital_status }}</p>
            @endif
          </td>
          @if(!empty($logoData))
            <td class="header-right">
              <img src="data:image/{{ $logoType }};base64,{{ $logoData }}" alt="{{ $user->name }}">
            </td>
          @endif
        </tr>
      </table>

      @if ($user->objective)
        <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ __('cv.objective') }}:</h2>
        <p>{{ $user->objective }}</p>
      @endif

      @if (tenant()->is_show_experience && $experiences->count() > 0)
        <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ __('cv.experience') }}:</h2>
        @foreach ($experiences as $experience)
          <table style="margin-bottom:-15px;" class="two-col">
            <tr>
              <td class="left">
                <p><b>{{ $experience->title }}@if($experience->company) · {{ $experience->company }}@endif</b></p>
                @if($experience->location || $experience->employment_type)
                  <p>
                    {{ collect([
                      $experience->location,
                      $experience->employment_type ? __('cv.employment.' . $experience->employment_type) : null
                    ])->filter()->implode(' · ') }}
                  </p>
                @endif
                @if($experience->description)
                  <ul><li>{{ $experience->description }}</li></ul>
                @endif
              </td>
              <td class="right">
                {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} –
                {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M Y') : __('app.present') }}
              </td>
            </tr>
          </table>
        @endforeach
      @endif

      @if (tenant()->is_show_educational && $educationals->count() > 0)
        <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ __('cv.education') }}:</h2>
        @foreach ($educationals as $educational)
          <table class="two-col" style="margin-bottom:-15px;">
            <tr>
              <td class="left">
                <p>
                  <b>{{ $educational->educational }}</b>
                  @if($educational->institution)<br>{{ $educational->institution }}@endif
                  @if($educational->degree || $educational->field)
                    <br>{{ collect([$educational->degree, $educational->field])->filter()->implode(' · ') }}
                  @endif
                </p>
              </td>
              <td class="right">
                {{ \Carbon\Carbon::parse($educational->start_date)->format('M Y') }} –
                {{ $educational->end_date ? \Carbon\Carbon::parse($educational->end_date)->format('M Y') : __('app.present') }}
              </td>
            </tr>
          </table>
        @endforeach
      @endif

      @if (tenant()->is_show_certification && $certifications->count() > 0)
        <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ __('cv.certifications') }}:</h2>
        @foreach ($certifications as $item)
          <table class="two-col" style="margin-bottom:-15px;">
            <tr>
              <td class="left">
                <p><b>{{ $item->title }}</b>@if($item->issuer) — {{ $item->issuer }}@endif</p>
              </td>
              <td class="right">{{ $item->issued_at ? \Carbon\Carbon::parse($item->issued_at)->format('M Y') : '' }}</td>
            </tr>
          </table>
        @endforeach
      @endif

      @if (tenant()->is_show_course && $courses->count() > 0)
        <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ __('cv.courses') }}:</h2>
        @foreach ($courses as $item)
          <table class="two-col" style="margin-bottom:-15px;">
            <tr>
              <td class="left">
                <p><b>{{ $item->title }}</b>@if($item->provider) — {{ $item->provider }}@endif</p>
              </td>
              <td class="right">
                @if($item->start_date){{ \Carbon\Carbon::parse($item->start_date)->format('M Y') }}@endif
                @if($item->end_date) – {{ \Carbon\Carbon::parse($item->end_date)->format('M Y') }}@endif
              </td>
            </tr>
          </table>
        @endforeach
      @endif

      @if (tenant()->is_show_award && $awards->count() > 0)
        <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ __('cv.awards') }}:</h2>
        @foreach ($awards as $item)
          <table class="two-col" style="margin-bottom:-15px;">
            <tr>
              <td class="left">
                <p><b>{{ $item->title }}</b>@if($item->issuer) — {{ $item->issuer }}@endif</p>
                @if($item->description)<p>{{ $item->description }}</p>@endif
              </td>
              <td class="right">{{ $item->awarded_at ? \Carbon\Carbon::parse($item->awarded_at)->format('M Y') : '' }}</td>
            </tr>
          </table>
        @endforeach
      @endif

      @if (tenant()->is_show_volunteering && $volunteerings->count() > 0)
        <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ __('cv.volunteering') }}:</h2>
        @foreach ($volunteerings as $item)
          <table class="two-col" style="margin-bottom:-15px;">
            <tr>
              <td class="left">
                <p><b>{{ $item->organization }}@if($item->role) · {{ $item->role }}@endif</b></p>
                @if($item->description)<ul><li>{{ $item->description }}</li></ul>@endif
              </td>
              <td class="right">
                @if($item->start_date){{ \Carbon\Carbon::parse($item->start_date)->format('M Y') }}@endif
                @if($item->end_date) – {{ \Carbon\Carbon::parse($item->end_date)->format('M Y') }}
                @elseif($item->start_date) – {{ __('app.present') }}@endif
              </td>
            </tr>
          </table>
        @endforeach
      @endif

      @if (tenant()->is_show_skill && $skills->count() > 0)
        <h2 style="text-decoration: underline;margin-bottom:-2px;">{{ __('cv.skills') }}:</h2>
        <ul>
          @foreach ($skills as $skill)
            <li>
              {{ $skill->skill }}
              @if($skill->level) ({{ $skill->level }})@endif
              @if($skill->category) — {{ __('cv.skill_category.' . $skill->category) }}@endif
            </li>
          @endforeach
        </ul>
      @endif

      @if (tenant()->is_show_language && $languages->count() > 0)
        <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ __('cv.languages') }}:</h2>
        @foreach ($languages as $language)
          <p style="margin-bottom:-10px;"><b>{{ $language->language }}:</b> {{ $language->description }}</p>
        @endforeach
      @endif

      @if (tenant()->is_show_project && $projects->count() > 0)
        <h2 style="text-decoration: underline; margin-bottom: -2px;">{{ __('cv.work_samples') }}:</h2>
        <ul style="list-style-type: disc; padding-left: 20px;">
          @if($projectGroups->count())
            @foreach ($projectGroups as $projectGroup)
              <li style="font-size: 16px; font-weight: bold; margin-top: 10px;">
                {{ $projectGroup->project_work }}:
                <ul style="list-style-type: none; padding-left: 20px; margin-top:5px;">
                  @foreach ($projects->where('project_work_id', $projectGroup->id) as $project)
                    <li style="font-weight: normal; margin-bottom:5px;">
                      <span>{{ $project->title }}</span>
                      @if(is_array($project->tags) && count($project->tags) > 0)
                        <span>({{ implode(', ', $project->tags) }})</span>
                      @endif
                      <br>
                      @if($project->source_code)
                        <span> > {{ __('app.source') }}: <a href="{{ $project->source_code }}">{{ $project->source_code }}</a></span><br>
                      @endif
                      @if($project->website_url)
                        <span> > {{ __('app.live_site') }}: <a href="{{ $project->website_url }}">{{ $project->website_url }}</a></span>
                      @endif
                    </li>
                  @endforeach
                </ul>
              </li>
            @endforeach
            @foreach ($projects->whereNull('project_work_id') as $project)
              <li style="font-weight: normal; margin-bottom:5px;">
                <span>{{ $project->title }}</span>
                @if($project->source_code)<br>> {{ __('app.source') }}: {{ $project->source_code }}@endif
                @if($project->website_url)<br>> {{ __('app.live_site') }}: {{ $project->website_url }}@endif
              </li>
            @endforeach
          @else
            @foreach ($projects as $project)
              <li>
                <b>{{ $project->title }}</b>
                @if($project->role) — {{ $project->role }}@endif
                @if($project->description)<br>{{ $project->description }}@endif
              </li>
            @endforeach
          @endif
        </ul>
      @endif

      @if (tenant()->is_show_website && $websites->count() > 0)
        <h2 style="text-decoration: underline; margin-bottom:-2px;">{{ __('cv.online_presence') }}:</h2>
        <ul>
          @foreach ($websites as $website)
            <li>{{ $website->name }} - <a href="{{ $website->url }}">{{ $website->url }}</a></li>
          @endforeach
        </ul>
      @endif

      @if (tenant()->is_show_link && $links->count() > 0)
        <h2 style="text-decoration: underline; margin-bottom:-2px;">{{ __('dashboard.links') }}:</h2>
        <ul>
          @foreach ($links as $link)
            @php $iconName = \Illuminate\Support\Str::after($link->icon, 'bi bi-'); @endphp
            <li>{{ ucfirst($iconName) }} - <a href="{{ $link->link }}">{{ $link->link }}</a></li>
          @endforeach
        </ul>
      @endif

      @if (tenant()->is_show_reference && $references->count() > 0)
        <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ __('cv.references') }}:</h2>
        @foreach ($references as $item)
          <p style="margin-bottom:8px;">
            <b>{{ $item->name }}</b>
            @if($item->position || $item->company)
              — {{ collect([$item->position, $item->company])->filter()->implode(', ') }}
            @endif
            @if($item->email)<br>{{ $item->email }}@endif
            @if($item->phone)<br>{{ $item->phone }}@endif
          </p>
        @endforeach
      @endif

    </div>
  </div>
</body>
</html>
