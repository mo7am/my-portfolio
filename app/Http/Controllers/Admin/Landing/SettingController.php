<?php

namespace App\Http\Controllers\Admin\Landing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Landing\LandingSettingRequest;
use App\Libraries\LandingSettingLibrary;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function __construct(
        protected readonly LandingSettingLibrary $landingSettingLibrary
    ) {}

    public function edit(): View
    {
        $settings = $this->landingSettingLibrary->current();

        return view('admin.landing.settings.edit', compact('settings'));
    }

    public function update(LandingSettingRequest $request): RedirectResponse
    {
        $this->landingSettingLibrary->save(
            $request->validated(),
            $this->landingSettingLibrary->current()
        );

        return redirect()
            ->route('admins.landing.settings.edit')
            ->with('success', __('messages.settings_updated'));
    }
}
