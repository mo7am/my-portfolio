<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExperienceRequest;
use App\Libraries\ExperienceLibrary;
use App\Models\Experience;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExperienceController extends Controller
{
    public function __construct(
        protected readonly ExperienceLibrary $experienceLibrary
    ) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->experienceLibrary->all(withoutGet: true);
            return DataTables::eloquent($data)
                ->addColumn('start_date', function ($data) {
                    return Carbon::parse($data->start_date)->format('m/d/Y');
                })
                ->addColumn('end_date', function ($data) {
                    return Carbon::parse($data->end_date)->format('m/d/Y');
                })
                ->filterColumn('start_date', function ($query, $keyword) {
                    return $query->whereRaw("DATE_FORMAT(start_date, '%m/%d/%Y') like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('end_date', function ($query, $keyword) {
                    return $query->whereRaw("DATE_FORMAT(end_date, '%m/%d/%Y') like ?", ["%{$keyword}%"]);
                })
                ->orderColumn('start_date', function ($query, $order) {
                    $query->orderBy('start_date', $order);
                })
                ->orderColumn('end_date', function ($query, $order) {
                    $query->orderBy('end_date', $order);
                })
                ->rawColumns(['start_date', 'end_date'])
                ->toJson();
        }
        return view('client.experiences.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $experience = new Experience();
        return view('client.experiences.create', compact('experience'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExperienceRequest $request)
    {
        $this->experienceLibrary->save($request->validated());
        return redirect()->route('clients.experiences.index')->with('success', 'Experience created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $experience = $this->experienceLibrary->getByID($id);
        return view('client.experiences.edit', compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExperienceRequest $request, $id)
    {
        $this->experienceLibrary->save($request->validated(), $this->experienceLibrary->getByID($id));
        return redirect()->route('clients.experiences.index')->with('success', 'Experience updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->experienceLibrary->deleteByID($id);
        return response()->json([
            'status' => true,
            'message' => 'Experience deleted successfully'
        ]);
    }
}
