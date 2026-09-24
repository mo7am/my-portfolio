<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <title>{{ pdf_text(__('app.resume')) }}</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12pt;
            margin: 20px;
            height: 100%;
            /* Glyphs from ArPHP are already in visual LTR order for DomPDF */
            direction: ltr;
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

        .header-left {
            width: 70%;
        }

        .header-left p {
            margin: 4px 0;
        }

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

        .two-col .left {
            width: 70%;
        }

        .two-col .right {
            width: 30%;
            text-align: {{ app()->getLocale() === 'ar' ? 'left' : 'right' }};
            padding-top: 30px;
            padding-right: 50px;
        }

        ul {
            margin: 5px 0 5px 20px;
            padding: 0;
        }

        li {
            margin-bottom: 3px;
        }

        p {
            line-height: 1.4;
        }
    </style>
</head>

<body>
    <div class="outer-border">
        <div class="inner-border">

            <h1 style="font-size: 30px">{{ pdf_text(__('app.resume')) }}</h1>
            <h2 style="text-align:center; border:0; margin-top:5px;text-decoration: underline;font-size:23px">
                {{ pdf_text($user->name) }}</h2>
            @if ($user->job_title)
                <h4 style="text-align:center; border:0;font-size:16px; margin-top:-20px">{{ pdf_text($user->job_title) }}
                </h4>
            @endif

            <table class="header-table">
                <tr>
                    <td class="header-left">
                        <p><b>{{ pdf_text(__('cv.email')) }}:</b>
                            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                        </p>
                        @if ($user->phone)
                            <p><b>{{ pdf_text(__('cv.phone')) }}:</b>
                                <a href="https://wa.me/{{ $user->phone }}">{{ $user->phone }}</a>
                            </p>
                        @endif
                        @if ($user->address)
                            <p><b>{{ pdf_text(__('cv.address')) }}:</b> {{ pdf_text($user->address) }}</p>
                        @endif
                        @if ($user->birthdate)
                            <p><b>{{ pdf_text(__('cv.date_of_birth')) }}:</b> {{ pdf_date($user->birthdate) }}</p>
                        @endif
                        @if ($user->nationality)
                            <p><b>{{ pdf_text(__('cv.nationality')) }}:</b> {{ pdf_text($user->nationality) }}</p>
                        @endif
                        @if ($user->marital_status)
                            <p><b>{{ pdf_text(__('cv.marital_status')) }}:</b>
                                {{ pdf_text(marital_status_label($user->marital_status)) }}</p>
                        @endif
                    </td>
                    @if (!empty($logoData))
                        <td class="header-right">
                            <img src="data:image/{{ $logoType }};base64,{{ $logoData }}"
                                alt="{{ pdf_text($user->name) }}">
                        </td>
                    @endif
                </tr>
            </table>

            @if ($user->objective)
                <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ pdf_text(__('cv.objective')) }}:</h2>
                <p>{{ pdf_text($user->objective) }}</p>
            @endif

            @if (tenant()->is_show_experience && $experiences->count() > 0)
                <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ pdf_text(__('cv.experience')) }}:</h2>
                @foreach ($experiences as $experience)
                    <table style="margin-bottom:-15px;" class="two-col">
                        <tr>
                            <td class="left">
                                <p><b>{{ pdf_text(collect([$experience->title, $experience->company])->filter()->implode(' · ')) }}</b>
                                </p>
                                @if ($experience->location || $experience->employment_type)
                                    <p>
                                        {{ pdf_text(
                                            collect([
                                                $experience->location,
                                                $experience->employment_type ? __('cv.employment.' . $experience->employment_type) : null,
                                            ])->filter()->implode(' · '),
                                        ) }}
                                    </p>
                                @endif
                                @if ($experience->description)
                                    <ul>
                                        <li>{{ pdf_text($experience->description) }}</li>
                                    </ul>
                                @endif
                            </td>
                            <td class="right">
                                {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} –
                                {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M Y') : pdf_text(__('app.present')) }}
                            </td>
                        </tr>
                    </table>
                @endforeach
            @endif

            @if (tenant()->is_show_educational && $educationals->count() > 0)
                <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ pdf_text(__('cv.education')) }}:</h2>
                @foreach ($educationals as $educational)
                    <table class="two-col" style="margin-bottom:-15px;">
                        <tr>
                            <td class="left">
                                <p>
                                    <b>{{ pdf_text($educational->educational) }}</b>
                                    @if ($educational->institution)
                                        <br>{{ pdf_text($educational->institution) }}
                                    @endif
                                    @if ($educational->degree || $educational->field)
                                        <br>{{ pdf_text(collect([$educational->degree, $educational->field])->filter()->implode(' · ')) }}
                                    @endif
                                </p>
                            </td>
                            <td class="right">
                                {{ \Carbon\Carbon::parse($educational->start_date)->format('M Y') }} –
                                {{ $educational->end_date ? \Carbon\Carbon::parse($educational->end_date)->format('M Y') : pdf_text(__('app.present')) }}
                            </td>
                        </tr>
                    </table>
                @endforeach
            @endif

            @if (tenant()->is_show_certification && $certifications->count() > 0)
                <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ pdf_text(__('cv.certifications')) }}:
                </h2>
                @foreach ($certifications as $item)
                    <table class="two-col" style="margin-bottom:-15px;">
                        <tr>
                            <td class="left">
                                <p><b>{{ pdf_text($item->title) }}</b>
                                    @if ($item->issuer)
                                        — {{ pdf_text($item->issuer) }}
                                    @endif
                                </p>
                            </td>
                            <td class="right">
                                {{ $item->issued_at ? \Carbon\Carbon::parse($item->issued_at)->format('M Y') : '' }}
                            </td>
                        </tr>
                    </table>
                @endforeach
            @endif

            @if (tenant()->is_show_course && $courses->count() > 0)
                <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ pdf_text(__('cv.courses')) }}:</h2>
                @foreach ($courses as $item)
                    <table class="two-col" style="margin-bottom:-15px;">
                        <tr>
                            <td class="left">
                                <p><b>{{ pdf_text($item->title) }}</b>
                                    @if ($item->provider)
                                        — {{ pdf_text($item->provider) }}
                                    @endif
                                </p>
                            </td>
                            <td class="right">
                                @if ($item->start_date)
                                    {{ \Carbon\Carbon::parse($item->start_date)->format('M Y') }}
                                @endif
                                @if ($item->end_date)
                                    – {{ \Carbon\Carbon::parse($item->end_date)->format('M Y') }}
                                @endif
                            </td>
                        </tr>
                    </table>
                @endforeach
            @endif

            @if (tenant()->is_show_award && $awards->count() > 0)
                <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ pdf_text(__('cv.awards')) }}:</h2>
                @foreach ($awards as $item)
                    <table class="two-col" style="margin-bottom:-15px;">
                        <tr>
                            <td class="left">
                                <p><b>{{ pdf_text($item->title) }}</b>
                                    @if ($item->issuer)
                                        — {{ pdf_text($item->issuer) }}
                                    @endif
                                </p>
                                @if ($item->description)
                                    <p>{{ pdf_text($item->description) }}</p>
                                @endif
                            </td>
                            <td class="right">
                                {{ $item->awarded_at ? \Carbon\Carbon::parse($item->awarded_at)->format('M Y') : '' }}
                            </td>
                        </tr>
                    </table>
                @endforeach
            @endif

            @if (tenant()->is_show_volunteering && $volunteerings->count() > 0)
                <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ pdf_text(__('cv.volunteering')) }}:
                </h2>
                @foreach ($volunteerings as $item)
                    <table class="two-col" style="margin-bottom:-15px;">
                        <tr>
                            <td class="left">
                                <p><b>{{ pdf_text(collect([$item->organization, $item->role])->filter()->implode(' · ')) }}</b>
                                </p>
                                @if ($item->description)
                                    <ul>
                                        <li>{{ pdf_text($item->description) }}</li>
                                    </ul>
                                @endif
                            </td>
                            <td class="right">
                                @if ($item->start_date)
                                    {{ \Carbon\Carbon::parse($item->start_date)->format('M Y') }}
                                @endif
                                @if ($item->end_date)
                                    – {{ \Carbon\Carbon::parse($item->end_date)->format('M Y') }}
                                @elseif($item->start_date)
                                    – {{ pdf_text(__('app.present')) }}
                                @endif
                            </td>
                        </tr>
                    </table>
                @endforeach
            @endif

            @if (tenant()->is_show_skill && $skills->count() > 0)
                <h2 style="text-decoration: underline;margin-bottom:-2px;">{{ pdf_text(__('cv.skills')) }}:</h2>
                <ul>
                    @foreach ($skills as $skill)
                        <li>
                            {{ pdf_text(trim($skill->skill . ($skill->level ? ' (' . $skill->level . ')' : '') . ($skill->category ? ' — ' . __('cv.skill_category.' . $skill->category) : ''))) }}
                        </li>
                    @endforeach
                </ul>
            @endif

            @if (tenant()->is_show_language && $languages->count() > 0)
                <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ pdf_text(__('cv.languages')) }}:</h2>
                @foreach ($languages as $language)
                    <p style="margin-bottom:-10px;"><b>{{ pdf_text($language->language) }}:</b>
                        {{ pdf_text($language->description) }}</p>
                @endforeach
            @endif

            @if (tenant()->is_show_project && $projects->count() > 0)
                <h2 style="text-decoration: underline; margin-bottom: -2px;">{{ pdf_text(__('cv.work_samples')) }}:
                </h2>
                <ul style="list-style-type: disc; padding-left: 20px;">
                    @if ($projectGroups->count())
                        @foreach ($projectGroups as $projectGroup)
                            <li style="font-size: 16px; font-weight: bold; margin-top: 10px;">
                                {{ pdf_text($projectGroup->project_work) }}:
                                <ul style="list-style-type: none; padding-left: 20px; margin-top:5px;">
                                    @foreach ($projects->where('project_work_id', $projectGroup->id) as $project)
                                        <li style="font-weight: normal; margin-bottom:5px;">
                                            <span>{{ pdf_text($project->title) }}</span>
                                            @if (is_array($project->tags) && count($project->tags) > 0)
                                                <span>({{ pdf_text(implode(', ', $project->tags)) }})</span>
                                            @endif
                                            <br>
                                            @if ($project->source_code)
                                                <span> > {{ pdf_text(__('app.source')) }}: <a
                                                        href="{{ $project->source_code }}">{{ $project->source_code }}</a></span><br>
                                            @endif
                                            @if ($project->website_url)
                                                <span> > {{ pdf_text(__('app.live_site')) }}: <a
                                                        href="{{ $project->website_url }}">{{ $project->website_url }}</a></span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                        @foreach ($projects->whereNull('project_work_id') as $project)
                            <li style="font-weight: normal; margin-bottom:5px;">
                                <span>{{ pdf_text($project->title) }}</span>
                                @if ($project->source_code)
                                    <br>> {{ pdf_text(__('app.source')) }}: {{ $project->source_code }}
                                @endif
                                @if ($project->website_url)
                                    <br>> {{ pdf_text(__('app.live_site')) }}: {{ $project->website_url }}
                                @endif
                            </li>
                        @endforeach
                    @else
                        @foreach ($projects as $project)
                            <li>
                                <b>{{ pdf_text($project->title) }}</b>
                                @if ($project->role)
                                    — {{ pdf_text($project->role) }}
                                @endif
                                @if ($project->description)
                                    <br>{{ pdf_text($project->description) }}
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ul>
            @endif

            @if (tenant()->is_show_website && $websites->count() > 0)
                <h2 style="text-decoration: underline; margin-bottom:-2px;">{{ pdf_text(__('cv.online_presence')) }}:
                </h2>
                <ul>
                    @foreach ($websites as $website)
                        <li>{{ pdf_text($website->name) }} - <a href="{{ $website->url }}">{{ $website->url }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif

            @if (tenant()->is_show_link && $links->count() > 0)
                <h2 style="text-decoration: underline; margin-bottom:-2px;">{{ pdf_text(__('dashboard.links')) }}:</h2>
                <ul>
                    @foreach ($links as $link)
                        @php $iconName = \Illuminate\Support\Str::after($link->icon, 'bi bi-'); @endphp
                        <li>{{ ucfirst($iconName) }} - <a href="{{ $link->link }}">{{ $link->link }}</a></li>
                    @endforeach
                </ul>
            @endif

            @if (tenant()->is_show_reference && $references->count() > 0)
                <h2 style="text-decoration: underline; margin-bottom:-15px;">{{ pdf_text(__('cv.references')) }}:</h2>
                @foreach ($references as $item)
                    <p style="margin-bottom:8px;">
                        <b>{{ pdf_text($item->name) }}</b>
                        @if ($item->position || $item->company)
                            — {{ pdf_text(collect([$item->position, $item->company])->filter()->implode(', ')) }}
                        @endif
                        @if ($item->email)
                            <br>{{ $item->email }}
                        @endif
                        @if ($item->phone)
                            <br>{{ $item->phone }}
                        @endif
                    </p>
                @endforeach
            @endif

        </div>
    </div>
</body>

</html>
