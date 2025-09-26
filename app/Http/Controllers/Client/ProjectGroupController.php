<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectGroupRequest;
use App\Libraries\ProjectGroupLibrary;
use App\Models\ProjectWork;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProjectGroupController extends Controller
{
    public function __construct(
        protected readonly ProjectGroupLibrary $projectGroupLibrary
    ) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->projectGroupLibrary->all(withoutGet: true);
            return DataTables::eloquent($data)
                ->rawColumns([])
                ->toJson();
        }
        return view('client.project-groups.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectGroup = new ProjectWork();
        return view('client.project-groups.create', compact('projectGroup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectGroupRequest $request)
    {
        $this->projectGroupLibrary->save($request->validated());
        return redirect()->route('clients.project-groups.index')->with('success', 'Project group created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projectGroup = $this->projectGroupLibrary->getByID($id);
        return view('client.project-groups.edit', compact('projectGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectGroupRequest $request, $id)
    {
        $this->projectGroupLibrary->save($request->validated(), $this->projectGroupLibrary->getByID($id));
        return redirect()->route('clients.project-groups.index')->with('success', 'Project group updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->projectGroupLibrary->deleteByID($id);
        return response()->json([
            'status' => true,
            'message' => 'Project group deleted successfully'
        ]);
    }
}
