<?php

namespace App\Http\Controllers\Resume;

use App\Libraries\UserLibrary;
use App\Libraries\ExperienceLibrary;
use App\Libraries\EducationalLibrary;
use App\Libraries\LanguageLibrary;
use App\Libraries\SkillLibrary;
use App\Http\Controllers\Controller;
use App\Libraries\LinkLibrary;
use App\Libraries\ProjectGroupLibrary;
use App\Libraries\ProjectLibrary;
use App\Libraries\WebsiteLibrary;
use Barryvdh\DomPDF\Facade\Pdf;

class ResumeController extends Controller
{
    public function __construct(
        protected readonly UserLibrary $userLibrary,
        protected readonly ExperienceLibrary $experienceLibrary,
        protected readonly EducationalLibrary $educationalLibrary,
        protected readonly LanguageLibrary $languageLibrary,
        protected readonly SkillLibrary $skillLibrary,
        protected readonly ProjectLibrary $projectLibrary,
        protected readonly ProjectGroupLibrary $projectGroupLibrary,
        protected readonly LinkLibrary $linkLibrary,
        protected readonly WebsiteLibrary $websiteLibrary,
    ) {}

    public function index()
    {
        $user = tenant()->user;
        $experiences = $this->experienceLibrary->all(orderBy: ['id' => 'desc']);
        $educationals = $this->educationalLibrary->all();
        $languages = $this->languageLibrary->all();
        $skills = $this->skillLibrary->all();
        $websites = $this->websiteLibrary->all();
        return view('resume.resume', compact('user', 'experiences', 'educationals', 'languages', 'skills', 'websites'));
    }

    public function download()
    {
        $user = tenant()->user;
        $media = $user->getFirstMedia('logo');

        if ($media) {
            $logoPath = $media->getPath();
        } else {
            $logoPath = public_path('logos/logo.png');
        }
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoType = pathinfo($logoPath, PATHINFO_EXTENSION);
        $experiences = $this->experienceLibrary->all(orderBy: ['id' => 'desc']);
        $educationals = $this->educationalLibrary->all();
        $languages = $this->languageLibrary->all();
        $skills = $this->skillLibrary->all();
        $projects = $this->projectLibrary->all();
        $projectGroups = $this->projectGroupLibrary->all();
        $links = $this->linkLibrary->all();
        $websites = $this->websiteLibrary->all();
        $pdfContent = PDF::loadView('resume.pdf', compact('user', 'experiences', 'educationals', 'languages', 'skills', 'logoData', 'logoType', 'projects', 'projectGroups', 'links', 'websites'))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'isPhpEnabled' => true,
            ]);

        return $pdfContent->stream($user->first_name . '-' . $user->second_name . '-' . $user->third_name . '-Resume.pdf' );
    }
}
