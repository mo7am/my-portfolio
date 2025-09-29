<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Libraries\UserLibrary;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\UserRequest;
use App\Libraries\ActivityLibrary;
use App\Libraries\TenantLibrary;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(
        protected readonly UserLibrary $userLibrary,
        protected readonly TenantLibrary $tenantLibrary,
        protected readonly ActivityLibrary $activityLibrary
    ) {}

    public function showAdminProfile(Request $request)
    {
        $user = auth('sanctum')->user();
        $users_count = $this->userLibrary->getUserCount(['type' => UserType::CLIENT->value]);

        $activities = $this->activityLibrary->getActivityList(
            setting: ['perPage' => 6],
            filters: ['nullable_tenant' => true],
            orderBy: ['id' => 'desc']
        );

        if ($request->ajax()) {
            return view('client.profile.partials.activity-items', compact('activities'))->render();
        }

        return view('admin.profile.show', compact('user', 'users_count', 'activities'));
    }

    public function showClientProfile(Request $request)
    {
        $user = auth('sanctum')->user();

        $tenant = $this->tenantLibrary->getById(
            $user->tenant_id,
            ['withCount' => ['projects', 'languages']]
        );

        $activities = $this->activityLibrary->getActivityList(
            setting: ['perPage' => 6],
            filters: ['tenant_id' => $tenant->id],
            orderBy: ['id' => 'desc']
        );

        if ($request->ajax()) {
            return view('client.profile.partials.activity-items', compact('activities'))->render();
        }

        return view('client.profile.show', compact('user', 'tenant', 'activities'));
    }

    public function updateClientProfile(ClientRequest $request)
    {
        $domain = strtolower($request->domain);
        $user = $this->userLibrary->save(array_merge($request->except('logo', 'domain'), ['domain' => $domain]), auth('sanctum')->user());
        if ($request->hasFile('logo')) {
            $user->addMediaFromRequest('logo')->toMediaCollection('logo', 'users');
            $user->load('media');
        }
        return redirect()->back()->with('success', 'Your informations updated successfully');
    }

    public function updateAdminProfile(UserRequest $request)
    {
        $user = $this->userLibrary->save($request->except('logo'), auth('sanctum')->user());
        if ($request->hasFile('logo')) {
            $user->addMediaFromRequest('logo')->toMediaCollection('logo', 'users');
            $user->load('media');
        }
        return redirect()->back()->with('success', 'Your informations updated successfully');
    }
}
