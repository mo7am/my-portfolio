<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AwardRequest;
use App\Libraries\AwardLibrary;
use App\Models\Award;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AwardController extends Controller
{
    public function __construct(
        protected readonly AwardLibrary $awardLibrary
    ) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->awardLibrary->all(withoutGet: true);

            return DataTables::eloquent($data)->rawColumns([])->toJson();
        }

        return view('client.awards.index');
    }

    public function create()
    {
        $award = new Award;

        return view('client.awards.create', compact('award'));
    }

    public function store(AwardRequest $request)
    {
        $this->awardLibrary->save($request->validated());

        return redirect()->route('clients.awards.index')->with('success', __('messages.created', ['item' => __('dashboard.award')]));
    }

    public function edit($id)
    {
        $award = $this->awardLibrary->getByID($id);

        return view('client.awards.edit', compact('award'));
    }

    public function update(AwardRequest $request, $id)
    {
        $this->awardLibrary->save($request->validated(), $this->awardLibrary->getByID($id));

        return redirect()->route('clients.awards.index')->with('success', __('messages.updated', ['item' => __('dashboard.award')]));
    }

    public function destroy($id)
    {
        $this->awardLibrary->deleteByID($id);

        return response()->json([
            'status' => true,
            'message' => __('messages.deleted', ['item' => __('dashboard.award')]),
        ]);
    }
}
