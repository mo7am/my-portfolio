<?php

namespace App\Http\Controllers\Admin\Landing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Landing\LandingTestimonialRequest;
use App\Libraries\LandingTestimonialLibrary;
use App\Models\LandingTestimonial;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class TestimonialController extends Controller
{
    public function __construct(
        protected readonly LandingTestimonialLibrary $landingTestimonialLibrary
    ) {}

    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $data = $this->landingTestimonialLibrary->all(
                orderBy: ['sort_order' => 'asc', 'id' => 'asc'],
                withoutGet: true
            );

            return DataTables::eloquent($data)
                ->editColumn('is_published', fn (LandingTestimonial $item) => $item->is_published
                    ? '<span class="badge bg-label-success">'.e(__('dashboard.published')).'</span>'
                    : '<span class="badge bg-label-secondary">'.e(__('dashboard.unpublished')).'</span>')
                ->rawColumns(['is_published'])
                ->toJson();
        }

        return view('admin.landing.testimonials.index');
    }

    public function create(): View
    {
        $testimonial = new LandingTestimonial([
            'sort_order' => $this->landingTestimonialLibrary->nextSortOrder(),
            'is_published' => true,
        ]);

        return view('admin.landing.testimonials.create', compact('testimonial'));
    }

    public function store(LandingTestimonialRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('photo');
        $data['sort_order'] ??= $this->landingTestimonialLibrary->nextSortOrder();

        /** @var LandingTestimonial $testimonial */
        $testimonial = $this->landingTestimonialLibrary->save($data);

        $this->storePhoto($testimonial, $request->file('photo'));

        return redirect()
            ->route('admins.landing.testimonials.index')
            ->with('success', __('messages.created', ['item' => __('dashboard.landing_testimonial')]));
    }

    public function edit(int $testimonial): View
    {
        $testimonial = $this->landingTestimonialLibrary->getByID($testimonial);

        return view('admin.landing.testimonials.edit', compact('testimonial'));
    }

    public function update(LandingTestimonialRequest $request, int $testimonial): RedirectResponse
    {
        /** @var LandingTestimonial $model */
        $model = $this->landingTestimonialLibrary->save(
            $request->safe()->except('photo'),
            $this->landingTestimonialLibrary->getByID($testimonial)
        );

        $this->storePhoto($model, $request->file('photo'));

        return redirect()
            ->route('admins.landing.testimonials.index')
            ->with('success', __('messages.updated', ['item' => __('dashboard.landing_testimonial')]));
    }

    public function destroy(int $testimonial): JsonResponse
    {
        $this->landingTestimonialLibrary->deleteByID($testimonial);

        return response()->json([
            'status' => true,
            'message' => __('messages.deleted', ['item' => __('dashboard.landing_testimonial')]),
        ]);
    }

    protected function storePhoto(LandingTestimonial $testimonial, ?UploadedFile $photo): void
    {
        if (! $photo) {
            return;
        }

        $testimonial->clearMediaCollection('photo');
        $testimonial
            ->addMedia($photo)
            ->usingFileName($this->safeFileName($photo))
            ->toMediaCollection('photo', 'landing');
    }

    protected function safeFileName(UploadedFile $file): string
    {
        $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');

        return 'testimonial-'.uniqid().'.'.$ext;
    }
}
