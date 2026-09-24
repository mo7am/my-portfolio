<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Libraries\ActivityLibrary;
use App\Libraries\TenantLibrary;
use App\Libraries\UserLibrary;
use App\Support\Filters\UserFilter;

class HomeController extends Controller
{
    public function __construct(
        protected readonly UserLibrary $userLibrary,
        protected readonly TenantLibrary $tenantLibrary,
        protected readonly ActivityLibrary $activityLibrary,
    ) {}

    public function index()
    {
        $users_count = $this->userLibrary->getUserCount(['type' => UserType::CLIENT->value]);
        $admins_count = $this->userLibrary->getUserCount(['type' => UserType::ADMIN->value]);
        $tenants_count = $this->tenantLibrary->getTenantCount();
        $activities_count = $this->activityLibrary->getActivityCount(['nullable_tenant' => true]);

        $recent_users = $this->userLibrary->all(
            filter: new UserFilter(['type' => UserType::CLIENT->value]),
            limit: 6,
            relations: ['media'],
            orderBy: ['id' => 'desc']
        );

        return view('admin.dashboard', compact(
            'users_count',
            'admins_count',
            'tenants_count',
            'activities_count',
            'recent_users'
        ));
    }
}
