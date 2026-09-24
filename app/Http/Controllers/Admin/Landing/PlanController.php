<?php

namespace App\Http\Controllers\Admin\Landing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Landing\LandingPlanRequest;
use App\Libraries\LandingPlanLibrary;
use App\Models\LandingPlan;
use App\Support\ContentLocale;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PlanController extends Controller
{
    public function __construct(
        protected readonly LandingPlanLibrary $landingPlanLibrary
    ) {}

    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $data = $this->landingPlanLibrary->all(
                orderBy: ['sort_order' => 'asc', 'id' => 'asc'],
                withoutGet: true
            );

            return DataTables::eloquent($data)
                ->editColumn('price_monthly', fn (LandingPlan $plan) => $plan->currency.' '.number_format((float) $plan->price_monthly, 2))
                ->editColumn('is_published', fn (LandingPlan $plan) => $plan->is_published
                    ? '<span class="badge bg-label-success">'.e(__('dashboard.published')).'</span>'
                    : '<span class="badge bg-label-secondary">'.e(__('dashboard.unpublished')).'</span>')
                ->rawColumns(['is_published'])
                ->toJson();
        }

        return view('admin.landing.plans.index');
    }

    public function create(): View
    {
        $plan = new LandingPlan([
            'sort_order' => $this->landingPlanLibrary->nextSortOrder(),
            'is_published' => true,
            'currency' => 'USD',
            'cta_route' => 'register',
            'price_monthly' => 0,
        ]);

        return view('admin.landing.plans.create', compact('plan'));
    }

    public function store(LandingPlanRequest $request): RedirectResponse
    {
        $this->persistPlan($request, new LandingPlan);

        return redirect()
            ->route('admins.landing.plans.index')
            ->with('success', __('messages.created', ['item' => __('dashboard.landing_plan')]));
    }

    public function edit(int $plan): View
    {
        $plan = $this->landingPlanLibrary->getByID($plan);

        return view('admin.landing.plans.edit', compact('plan'));
    }

    public function update(LandingPlanRequest $request, int $plan): RedirectResponse
    {
        /** @var LandingPlan $model */
        $model = $this->landingPlanLibrary->getByID($plan);
        $this->persistPlan($request, $model);

        return redirect()
            ->route('admins.landing.plans.index')
            ->with('success', __('messages.updated', ['item' => __('dashboard.landing_plan')]));
    }

    public function destroy(int $plan): JsonResponse
    {
        $this->landingPlanLibrary->deleteByID($plan);

        return response()->json([
            'status' => true,
            'message' => __('messages.deleted', ['item' => __('dashboard.landing_plan')]),
        ]);
    }

    protected function persistPlan(LandingPlanRequest $request, LandingPlan $plan): LandingPlan
    {
        $data = $request->safe()->except(['features_text', 'cta_params_json']);
        $data['sort_order'] ??= $plan->exists
            ? $plan->sort_order
            : $this->landingPlanLibrary->nextSortOrder();

        $plan->fill($data);
        $plan->setFeaturesForLocale(
            ContentLocale::current(),
            (string) $request->input('features_text', '')
        );

        $paramsJson = trim((string) $request->input('cta_params_json', ''));
        if ($paramsJson === '') {
            $plan->cta_params = ['plan' => $data['code']];
        } else {
            $decoded = json_decode($paramsJson, true);
            $plan->cta_params = is_array($decoded) ? $decoded : ['plan' => $data['code']];
        }

        $plan->save();

        return $plan;
    }
}
