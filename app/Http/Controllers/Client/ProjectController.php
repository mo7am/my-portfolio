<?php

namespace App\Http\Controllers\Client;

use App\Libraries\ProjectLibrary;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use App\Libraries\ProjectGroupLibrary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public function __construct(
        protected readonly ProjectLibrary $projectLibrary,
        protected readonly ProjectGroupLibrary $projectGroupLibrary
    ) {
        $this->middleware('check.setting:is_show_project', ['only' => ['projects']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->projectLibrary->all(withoutGet: true);
            return DataTables::eloquent($data)
                ->addColumn('date', function ($data) {
                    return Carbon::parse($data->start_date)->format('m/d/Y');
                })
                ->addColumn('project_group', function ($data) {
                    return $data->projectWork?->project_work;
                })

                ->filterColumn('date', function ($query, $keyword) {
                    return $query->whereRaw("DATE_FORMAT(date, '%m/%d/%Y') like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('project_group', function ($query, $keyword) {
                    $query->whereHas('projectWork', function ($q) use ($keyword) {
                        return $q->whereRaw("project_works.project_work like ?", ["%{$keyword}%"]);
                    });
                })
                
                ->orderColumn('date', function ($query, $order) {
                    $query->orderBy('date', $order);
                })
                ->orderColumn('project_group', function ($query, $order) {
                    $query->orderBy('project_work_id', $order);
                })
                
                ->rawColumns(['start_date', 'end_date', 'project_group'])
                ->toJson();
        }
        return view('client.projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        $projectGroups = $this->projectGroupLibrary->all();
        return view('client.projects.create', compact('project', 'projectGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $this->projectLibrary->save($request->validated());
        return redirect()->route('clients.projects.index')->with('success', 'Project created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = $this->projectLibrary->getByID($id);
        $projectGroups = $this->projectGroupLibrary->all();
        return view('client.projects.edit', compact('project', 'projectGroups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        $this->projectLibrary->save($request->validated(), $this->projectLibrary->getByID($id));
        return redirect()->route('clients.projects.index')->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->projectLibrary->deleteByID($id);
        return response()->json([
            'status' => true,
            'message' => 'Project deleted successfully'
        ]);
    }

    public function projects()
    {
        $projects = $this->projectLibrary->all();
        return view('resume.projects', compact('projects'));
    }
}
