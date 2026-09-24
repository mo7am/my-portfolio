<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Libraries\AwardLibrary;
use App\Libraries\CertificationLibrary;
use App\Libraries\CourseLibrary;
use App\Libraries\CvReferenceLibrary;
use App\Libraries\EducationalLibrary;
use App\Libraries\ExperienceLibrary;
use App\Libraries\LanguageLibrary;
use App\Libraries\LinkLibrary;
use App\Libraries\ProjectGroupLibrary;
use App\Libraries\ProjectLibrary;
use App\Libraries\SkillLibrary;
use App\Libraries\UserLibrary;
use App\Libraries\VolunteeringLibrary;
use App\Libraries\WebsiteLibrary;
use App\Models\User;
use App\Services\GoogleDriveCvService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

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
        protected readonly CertificationLibrary $certificationLibrary,
        protected readonly CourseLibrary $courseLibrary,
        protected readonly AwardLibrary $awardLibrary,
        protected readonly VolunteeringLibrary $volunteeringLibrary,
        protected readonly CvReferenceLibrary $referenceLibrary,
        protected readonly GoogleDriveCvService $googleDriveCvService,
    ) {}

    public function index()
    {
        $user = tenant()->user;
        $experiences = $this->experienceLibrary->all(orderBy: ['id' => 'desc']);
        $educationals = $this->educationalLibrary->all();
        $languages = $this->languageLibrary->all();
        $skills = $this->skillLibrary->all();
        $websites = $this->websiteLibrary->all();
        $projects = tenant()->is_show_project ? $this->projectLibrary->all(orderBy: ['id' => 'desc']) : collect();
        $certifications = tenant()->is_show_certification ? $this->certificationLibrary->all() : collect();
        $courses = tenant()->is_show_course ? $this->courseLibrary->all() : collect();
        $awards = tenant()->is_show_award ? $this->awardLibrary->all() : collect();
        $volunteerings = tenant()->is_show_volunteering ? $this->volunteeringLibrary->all() : collect();
        $references = tenant()->is_show_reference
            ? $this->referenceLibrary->all()->where('is_public', true)->values()
            : collect();
        $driveConfigured = $this->googleDriveCvService->isConfigured();

        return view('resume.resume', compact(
            'user', 'experiences', 'educationals', 'languages', 'skills', 'websites',
            'projects', 'certifications', 'courses', 'awards', 'volunteerings', 'references',
            'driveConfigured'
        ));
    }

    public function download()
    {
        $user = tenant()->user;
        $pdf = $this->makePdf($user);
        $fileName = $this->cvFileName($user);

        return $pdf->download($fileName);
    }

    public function viewPdf()
    {
        $user = tenant()->user;
        $pdf = $this->makePdf($user);
        $fileName = $this->cvFileName($user);

        return $pdf->stream($fileName);
    }

    public function shareToDrive(): JsonResponse
    {
        /** @var User $user */
        $user = tenant()->user;

        if (! $this->googleDriveCvService->isConfigured()) {
            return response()->json([
                'success' => false,
                'message' => __('app.drive_not_configured'),
            ], 503);
        }

        try {
            $pdfBinary = $this->makePdf($user)->output();
            $fileName = $this->cvFileName($user);

            $result = $this->googleDriveCvService->uploadCvPdf(
                $pdfBinary,
                $fileName,
                $user->cv_drive_file_id
            );

            $user->forceFill([
                'cv_drive_file_id' => $result['file_id'],
                'cv_drive_link' => $result['link'],
            ])->save();

            return response()->json([
                'success' => true,
                'link' => $result['link'],
                'message' => __('app.drive_upload_success'),
            ]);
        } catch (Throwable $e) {
            Log::error('Google Drive CV upload failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => str_contains($e->getMessage(), 'Service accounts cannot store')
                    || str_contains($e->getMessage(), 'storageQuotaExceeded')
                    ? __('app.drive_quota_error')
                    : __('app.drive_upload_failed'),
            ], 500);
        }
    }

    protected function makePdf(User $user)
    {
        $media = $user->getFirstMedia('logo');

        if ($media && is_file($media->getPath())) {
            $logoData = base64_encode(file_get_contents($media->getPath()));
            $logoType = $media->extension ?: 'png';
        } else {
            $fallback = public_path('logos/logo.png');
            $logoData = is_file($fallback) ? base64_encode(file_get_contents($fallback)) : '';
            $logoType = 'png';
        }

        $experiences = $this->experienceLibrary->all(orderBy: ['id' => 'desc']);
        $educationals = $this->educationalLibrary->all();
        $languages = $this->languageLibrary->all();
        $skills = $this->skillLibrary->all();
        $projects = $this->projectLibrary->all();
        $projectGroups = $this->projectGroupLibrary->all();
        $links = $this->linkLibrary->all();
        $websites = $this->websiteLibrary->all();
        $certifications = $this->certificationLibrary->all();
        $courses = $this->courseLibrary->all();
        $awards = $this->awardLibrary->all();
        $volunteerings = $this->volunteeringLibrary->all();
        $references = $this->referenceLibrary->all()->where('is_public', true)->values();

        $defaultFont = app()->getLocale() === 'ar' ? 'DejaVu Sans' : 'sans-serif';

        return Pdf::loadView('resume.pdf', compact(
            'user', 'experiences', 'educationals', 'languages', 'skills', 'logoData', 'logoType',
            'projects', 'projectGroups', 'links', 'websites', 'certifications', 'courses',
            'awards', 'volunteerings', 'references'
        ))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont' => $defaultFont,
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'isPhpEnabled' => true,
            ]);
    }

    protected function cvFileName(User $user): string
    {
        $base = trim(($user->first_name ?? '').'-'.($user->second_name ?? '').'-Resume');
        $base = Str::slug($base) ?: 'resume';

        return $base.'.pdf';
    }
}
