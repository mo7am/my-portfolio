<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Services\LandingContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function __construct(
        protected readonly LandingContentService $landingContentService
    ) {}

    public function index(): View|RedirectResponse
    {
        if (auth('sanctum')->check() && ! request()->boolean('preview')) {
            $type = auth('sanctum')->user()->type;

            if ($type === UserType::ADMIN->value) {
                return redirect()->route('admins.index');
            }

            if ($type === UserType::CLIENT->value) {
                return redirect()->route('clients.index');
            }
        }

        return view('landing.index', $this->landingContentService->forPublicPage());
    }
}
