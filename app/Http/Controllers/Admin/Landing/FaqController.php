<?php

namespace App\Http\Controllers\Admin\Landing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Landing\LandingFaqRequest;
use App\Libraries\LandingFaqLibrary;
use App\Models\LandingFaq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{
    public function __construct(
        protected readonly LandingFaqLibrary $landingFaqLibrary
    ) {}

    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $data = $this->landingFaqLibrary->all(
                orderBy: ['sort_order' => 'asc', 'id' => 'asc'],
                withoutGet: true
            );

            return DataTables::eloquent($data)
                ->editColumn('is_published', fn (LandingFaq $faq) => $faq->is_published
                    ? '<span class="badge bg-label-success">'.e(__('dashboard.published')).'</span>'
                    : '<span class="badge bg-label-secondary">'.e(__('dashboard.unpublished')).'</span>')
                ->rawColumns(['is_published'])
                ->toJson();
        }

        return view('admin.landing.faqs.index');
    }

    public function create(): View
    {
        $faq = new LandingFaq([
            'sort_order' => $this->landingFaqLibrary->nextSortOrder(),
            'is_published' => true,
        ]);

        return view('admin.landing.faqs.create', compact('faq'));
    }

    public function store(LandingFaqRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] ??= $this->landingFaqLibrary->nextSortOrder();

        $this->landingFaqLibrary->save($data);

        return redirect()
            ->route('admins.landing.faqs.index')
            ->with('success', __('messages.created', ['item' => __('dashboard.landing_faq')]));
    }

    public function edit(int $faq): View
    {
        $faq = $this->landingFaqLibrary->getByID($faq);

        return view('admin.landing.faqs.edit', compact('faq'));
    }

    public function update(LandingFaqRequest $request, int $faq): RedirectResponse
    {
        $this->landingFaqLibrary->save(
            $request->validated(),
            $this->landingFaqLibrary->getByID($faq)
        );

        return redirect()
            ->route('admins.landing.faqs.index')
            ->with('success', __('messages.updated', ['item' => __('dashboard.landing_faq')]));
    }

    public function destroy(int $faq): JsonResponse
    {
        $this->landingFaqLibrary->deleteByID($faq);

        return response()->json([
            'status' => true,
            'message' => __('messages.deleted', ['item' => __('dashboard.landing_faq')]),
        ]);
    }
}
