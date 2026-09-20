<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CertificationRequest;
use App\Libraries\CertificationLibrary;
use App\Models\Certification;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CertificationController extends Controller
{
    public function __construct(
        protected readonly CertificationLibrary $certificationLibrary
    ) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->certificationLibrary->all(withoutGet: true);

            return DataTables::eloquent($data)->rawColumns([])->toJson();
        }

        return view('client.certifications.index');
    }

    public function create()
    {
        $certification = new Certification;

        return view('client.certifications.create', compact('certification'));
    }

    public function store(CertificationRequest $request)
    {
        $this->certificationLibrary->save($request->validated());

        return redirect()->route('clients.certifications.index')->with('success', __('messages.created', ['item' => __('dashboard.certification')]));
    }

    public function edit($id)
    {
        $certification = $this->certificationLibrary->getByID($id);

        return view('client.certifications.edit', compact('certification'));
    }

    public function update(CertificationRequest $request, $id)
    {
        $this->certificationLibrary->save($request->validated(), $this->certificationLibrary->getByID($id));

        return redirect()->route('clients.certifications.index')->with('success', __('messages.updated', ['item' => __('dashboard.certification')]));
    }

    public function destroy($id)
    {
        $this->certificationLibrary->deleteByID($id);

        return response()->json([
            'status' => true,
            'message' => __('messages.deleted', ['item' => __('dashboard.certification')]),
        ]);
    }
}
