<?php

namespace App\Http\Controllers\Client;

use App\Libraries\ExperienceLibrary;
use App\Libraries\EducationalLibrary;
use App\Libraries\LanguageLibrary;
use App\Libraries\SkillLibrary;
use App\Http\Controllers\Controller;
use App\Libraries\LinkLibrary;
use App\Libraries\ProjectGroupLibrary;
use App\Libraries\ProjectLibrary;
use App\Libraries\WebsiteLibrary;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct(
        protected readonly ProjectLibrary $projectLibrary,
        protected readonly ExperienceLibrary $experienceLibrary,
        protected readonly EducationalLibrary $educationalLibrary,
        protected readonly LanguageLibrary $languageLibrary,
        protected readonly SkillLibrary $skillLibrary,
        protected readonly LinkLibrary $linkLibrary,
        protected readonly WebsiteLibrary $websiteLibrary,
        protected readonly ProjectGroupLibrary $projectGroupLibrary,
    ) {}

    public function index(Request $request)
    {
        $project_count = $this->projectLibrary->getProjectCount();
        $experience_count = $this->experienceLibrary->getExperienceCount();
        $educational_count = $this->educationalLibrary->getEducationalCount();
        $language_count = $this->languageLibrary->getLanguageCount();
        $skill_count = $this->skillLibrary->getSkillCount();
        $link_count = $this->linkLibrary->getLinkCount();
        $website_count = $this->websiteLibrary->getWebsiteCount();
        $project_group_count = $this->projectGroupLibrary->getProjectGroupCount();

        if ($request->ajax()) {
            $data = $this->projectLibrary->all(withoutGet: true);
            return DataTables::eloquent($data)
                ->addColumn('date', function ($data) {
                    return Carbon::parse($data->start_date)->format('m/d/Y');
                })
                ->addColumn('project_group', function ($data) {
                    return $data->projectWork?->project_work;
                })

                ->filterColumn('date', function ($query, $keyword) {
                    return $query->whereRaw("DATE_FORMAT(date, '%m/%d/%Y') like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('project_group', function ($query, $keyword) {
                    $query->whereHas('projectWork', function ($q) use ($keyword) {
                        return $q->whereRaw("project_works.project_work like ?", ["%{$keyword}%"]);
                    });
                })
                
                ->orderColumn('date', function ($query, $order) {
                    $query->orderBy('date', $order);
                })
                ->orderColumn('project_group', function ($query, $order) {
                    $query->orderBy('project_work_id', $order);
                })
                
                ->rawColumns(['start_date', 'end_date', 'project_group'])
                ->toJson();
        }
        
        return view('client.dashboard', compact('project_count', 'experience_count', 'educational_count', 'language_count', 'skill_count', 'link_count', 'website_count', 'project_group_count'));
    }
}
