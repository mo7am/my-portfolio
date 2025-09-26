<?php

namespace App\Http\Controllers\Resume;

use App\Libraries\UserLibrary;
use App\Libraries\ProjectLibrary;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct(
        protected readonly UserLibrary $userLibrary,
        protected readonly ProjectLibrary $projectLibrary
    ) {}

    public function index()
    {
        $user = tenant()->user;
        $projects = [];
        if (tenant()->is_show_project) {
            $projects = $this->projectLibrary->all(
                limit: 3,
            );
        }
        return view('resume.home', compact('user', 'projects'));
    }
}
