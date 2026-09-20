<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\VolunteeringRequest;
use App\Libraries\VolunteeringLibrary;
use App\Models\Volunteering;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VolunteeringController extends Controller
{
    public function __construct(
        protected readonly VolunteeringLibrary $volunteeringLibrary
    ) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->volunteeringLibrary->all(withoutGet: true);

            return DataTables::eloquent($data)->rawColumns([])->toJson();
        }

        return view('client.volunteerings.index');
    }

    public function create()
    {
        $volunteering = new Volunteering;

        return view('client.volunteerings.create', compact('volunteering'));
    }

    public function store(VolunteeringRequest $request)
    {
        $this->volunteeringLibrary->save($request->validated());

        return redirect()->route('clients.volunteerings.index')->with('success', __('messages.created', ['item' => __('dashboard.volunteering')]));
    }

    public function edit($id)
    {
        $volunteering = $this->volunteeringLibrary->getByID($id);

        return view('client.volunteerings.edit', compact('volunteering'));
    }

    public function update(VolunteeringRequest $request, $id)
    {
        $this->volunteeringLibrary->save($request->validated(), $this->volunteeringLibrary->getByID($id));

        return redirect()->route('clients.volunteerings.index')->with('success', __('messages.updated', ['item' => __('dashboard.volunteering')]));
    }

    public function destroy($id)
    {
        $this->volunteeringLibrary->deleteByID($id);

        return response()->json([
            'status' => true,
            'message' => __('messages.deleted', ['item' => __('dashboard.volunteering')]),
        ]);
    }
}
