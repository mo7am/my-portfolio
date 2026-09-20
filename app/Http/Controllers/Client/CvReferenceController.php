<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CvReferenceRequest;
use App\Libraries\CvReferenceLibrary;
use App\Models\CvReference;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CvReferenceController extends Controller
{
    public function __construct(
        protected readonly CvReferenceLibrary $referenceLibrary
    ) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->referenceLibrary->all(withoutGet: true);

            return DataTables::eloquent($data)->rawColumns([])->toJson();
        }

        return view('client.references.index');
    }

    public function create()
    {
        $reference = new CvReference;

        return view('client.references.create', compact('reference'));
    }

    public function store(CvReferenceRequest $request)
    {
        $this->referenceLibrary->save($request->validated());

        return redirect()->route('clients.references.index')->with('success', __('messages.created', ['item' => __('dashboard.reference')]));
    }

    public function edit($id)
    {
        $reference = $this->referenceLibrary->getByID($id);

        return view('client.references.edit', compact('reference'));
    }

    public function update(CvReferenceRequest $request, $id)
    {
        $this->referenceLibrary->save($request->validated(), $this->referenceLibrary->getByID($id));

        return redirect()->route('clients.references.index')->with('success', __('messages.updated', ['item' => __('dashboard.reference')]));
    }

    public function destroy($id)
    {
        $this->referenceLibrary->deleteByID($id);

        return response()->json([
            'status' => true,
            'message' => __('messages.deleted', ['item' => __('dashboard.reference')]),
        ]);
    }
}
