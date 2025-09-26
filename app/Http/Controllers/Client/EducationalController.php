<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\EducationalRequest;
use App\Libraries\EducationalLibrary;
use App\Models\Educational;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EducationalController extends Controller
{
    public function __construct(
        protected readonly EducationalLibrary $educationalLibrary
    ) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->educationalLibrary->all(withoutGet: true);
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
        return view('client.educationals.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $educational = new Educational();
        return view('client.educationals.create', compact('educational'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EducationalRequest $request)
    {
        $this->educationalLibrary->save($request->validated());
        return redirect()->route('clients.educationals.index')->with('success', 'Educational created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $educational = $this->educationalLibrary->getByID($id);
        return view('client.educationals.edit', compact('educational'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EducationalRequest $request, $id)
    {
        $this->educationalLibrary->save($request->validated(), $this->educationalLibrary->getByID($id));
        return redirect()->route('clients.educationals.index')->with('success', 'Educational updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->educationalLibrary->deleteByID($id);
        return response()->json([
            'status' => true,
            'message' => 'Educational deleted successfully'
        ]);
    }
}
