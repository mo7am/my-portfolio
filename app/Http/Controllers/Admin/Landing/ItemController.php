<?php

namespace App\Http\Controllers\Admin\Landing;

use App\Enums\LandingItemType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Landing\LandingItemRequest;
use App\Libraries\LandingItemLibrary;
use App\Models\LandingItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    public function __construct(
        protected readonly LandingItemLibrary $landingItemLibrary
    ) {}

    public function index(Request $request, string $type): View|JsonResponse
    {
        $itemType = $this->resolveType($type);

        if ($request->ajax()) {
            $data = $this->landingItemLibrary->queryByType($itemType, withoutGet: true);

            return DataTables::eloquent($data)
                ->editColumn('is_published', fn (LandingItem $item) => $item->is_published
                    ? '<span class="badge bg-label-success">'.e(__('dashboard.published')).'</span>'
                    : '<span class="badge bg-label-secondary">'.e(__('dashboard.unpublished')).'</span>')
                ->rawColumns(['is_published'])
                ->toJson();
        }

        return view('admin.landing.items.index', [
            'type' => $itemType,
        ]);
    }

    public function create(string $type): View
    {
        $itemType = $this->resolveType($type);
        $item = new LandingItem([
            'type' => $itemType,
            'sort_order' => $this->landingItemLibrary->nextSortOrder($itemType),
            'is_published' => true,
        ]);

        return view('admin.landing.items.create', [
            'type' => $itemType,
            'item' => $item,
        ]);
    }

    public function store(LandingItemRequest $request, string $type): RedirectResponse
    {
        $itemType = $this->resolveType($type);
        $data = $request->validated();
        $data['type'] = $itemType->value;
        $data['sort_order'] ??= $this->landingItemLibrary->nextSortOrder($itemType);

        $this->landingItemLibrary->save($data);

        return redirect()
            ->route('admins.landing.items.index', $itemType->value)
            ->with('success', __('messages.created', ['item' => $itemType->singular()]));
    }

    public function edit(string $type, int $item): View
    {
        $itemType = $this->resolveType($type);
        $item = $this->landingItemLibrary->getByIdAndType($item, $itemType);

        return view('admin.landing.items.edit', [
            'type' => $itemType,
            'item' => $item,
        ]);
    }

    public function update(LandingItemRequest $request, string $type, int $item): RedirectResponse
    {
        $itemType = $this->resolveType($type);
        $model = $this->landingItemLibrary->getByIdAndType($item, $itemType);
        $data = $request->validated();
        $data['type'] = $itemType->value;

        $this->landingItemLibrary->save($data, $model);

        return redirect()
            ->route('admins.landing.items.index', $itemType->value)
            ->with('success', __('messages.updated', ['item' => $itemType->singular()]));
    }

    public function destroy(string $type, int $item): JsonResponse
    {
        $itemType = $this->resolveType($type);
        $model = $this->landingItemLibrary->getByIdAndType($item, $itemType);
        $this->landingItemLibrary->deleteByID($model->id);

        return response()->json([
            'status' => true,
            'message' => __('messages.deleted', ['item' => $itemType->singular()]),
        ]);
    }

    protected function resolveType(string $type): LandingItemType
    {
        $itemType = LandingItemType::tryFrom($type);

        if (! $itemType) {
            throw new NotFoundHttpException;
        }

        return $itemType;
    }
}
