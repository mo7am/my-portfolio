<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CV</title>
  <style>
    @page { margin: 0; }

    body {
      font-family: "Times New Roman", Times, serif;
      font-size: 12pt;
      margin: 20px;
      height: 100%; 
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

    .header-left {
      width: 70%;
    }

    .header-left p {
      margin: 4px 0;
    }

    .header-right {
      width: 30%;
      text-align: right;
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
    .two-col .right { width: 30%; text-align: right; padding-top: 30px; padding-right: 50px;}

    ul { margin: 5px 0 5px 20px; padding: 0; }
    li { margin-bottom: 3px; }
    p { line-height: 1.4; }

    .lables {
      font-size: 17px;
    }
  </style>
</head>
<body>
  <div class="outer-border">
    <div class="inner-border">

      <!-- CV Title -->
      <h1 style="font-size: 30px">CV</h1>
      <h2 style="text-align:center; border:0; margin-top:5px;text-decoration: underline;font-size:23px">{{ ucwords($user->name) }}</h2>
      <h4 style="text-align:center; border:0;font-size:16px; margin-top:-20px">{{ ucwords($user->job_title) }}</h2>

      <!-- Personal Info + Image -->
      <table class="header-table">
        <tr>
          <td class="header-left">
            <p><b>Email:</b> <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $user->email }}" target="_blank" rel="noopener">
              {{ $user->email }}
            </a></p>
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
          </td>
          <td class="header-right">
            <img src="data:image/{{ $logoType }};base64,{{ $logoData }}" alt="Profile Picture">
          </td>
        </tr>
      </table>

      @if ($user->objective)
        <h2 style="text-decoration: underline; margin-bottom:-15px;">Objectives:</h2>
        <p>{{ $user->objective }}</p>
      @endif
      @if (tenant()->is_show_experience && $experiences->count() > 0)
        <h2 style="text-decoration: underline; margin-bottom:-15px;">Work Experience:</h2>
        @foreach ($experiences as $experience)
          <table style="margin-bottom:-15px;" class="two-col">
            <tr>
              <td class="left">
                <p><b>{{ $experience->title }} {{ $experience->company }}.</b></p>
                <ul>
                  <li>{{ $experience->description }}</li>
                </ul>
              </td>
              <td class="right">{{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} – {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M Y') : 'Present' }}</td>
            </tr>
          </table>
        @endforeach
      @endif
      <br>
      @if (tenant()->is_show_educational && $educationals->count() > 0)
        <h2 style="text-decoration: underline; margin-bottom:-15px;">Educational Qualifications:</h2>
        @foreach ($educationals as $educational)
          <table class="two-col" style="margin-bottom:-15px;">
            <tr>
              <td class="left">
                <p>{{ $educational->educational }}</p>
              </td>
              <td class="right">{{ \Carbon\Carbon::parse($educational->start_date)->format('M Y') }} – {{ \Carbon\Carbon::parse($educational->end_date)->format('M Y') }}</td>
            </tr>
          </table>
        @endforeach
      @endif

      @if (tenant()->is_show_skill && $skills->count() > 0)
        <h2 style="text-decoration: underline;margin-bottom:-2px;">Strengths & Skills:</h2>
        <ul>
          @foreach ($skills as $skill)
            <li>{{ $skill->skill }}</li>
          @endforeach
        </ul>
      @endif
        <br>
      @if (tenant()->is_show_language && $languages->count() > 0)
        <h2 style="text-decoration: underline; margin-bottom:-15px;">Languages:</h2>
          @foreach ($languages as $language)
            <p style="margin-bottom:-10px;"><b>{{ $language->language }}:</b> {{ $language->description }}</p>
          @endforeach
      @endif
      

      @if (tenant()->is_show_project && $projects->count() > 0)
        <h2 style="text-decoration: underline; margin-bottom: -2px;">My Projects:</h2>
        <ul style="list-style-type: disc; padding-left: 20px;">
            @foreach ($projectGroups as $projectGroup)
                <li style="font-size: 16px; font-weight: bold; margin-top: 10px;">
                    {{ $projectGroup->project_work }}:
                    <ul style="list-style-type: none; padding-left: 20px; margin-top:5px;">
                        @foreach ($projects as $project)
                            @if ($project->project_work_id === $projectGroup->id)
                                <li style="font-weight: normal; margin-bottom:5px;">
                                    <span style="font-weight: 100">{{ $project->title }}</span> @if(count($project->tags) > 0)<span>({{ implode(', ', $project->tags) }})</span> @endif<br>
                                    @if($project->source_code)
                                      <span style="margin-left: 20px;"> > Source Code: <a href="{{ $project->source_code }}" target="_blank">{{ $project->source_code }}</a></span>
                                      <br>
                                    @endif
                                    @if($project->website_url)
                                      <span style="margin-left: 20px;"> > Website Url: <a href="{{ $project->website_url }}" target="_blank">{{ $project->website_url }}</a></span>
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
      @endif

      @if (tenant()->is_show_website && $websites->count() > 0)
        <h2 style="text-decoration: underline; margin-bottom:-2px;">Online Websites:</h2>
        <ul>
          @foreach ($websites as $website)
            <li>{{ $website->name }} - <a href="{{ $website->url }}" target="_blank"> {{ $website->url }}</a></li>
          @endforeach
        </ul>
      @endif

      @if (tenant()->is_show_link && $links->count() > 0)
        <h2 style="text-decoration: underline; margin-bottom:-2px;">Links:</h2>
        <ul>
          @foreach ($links as $link)
          @php
            $iconName = \Illuminate\Support\Str::after($link->icon, 'bi bi-'); 
          @endphp
            <li>{{ ucfirst($iconName) }} - <a href="{{ $link->link }}" target="_blank"> {{ $link->link }}</a></li>
          @endforeach          
        </ul>
      @endif
    </div>
  </div>
</body>
</html>
