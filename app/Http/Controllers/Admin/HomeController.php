<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.dashboard');
    }
}
