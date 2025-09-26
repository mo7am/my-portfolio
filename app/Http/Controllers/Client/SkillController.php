<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillRequest;
use App\Libraries\SkillLibrary;
use App\Models\Skill;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SkillController extends Controller
{
    public function __construct(
        protected readonly SkillLibrary $skillLibrary
    ) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->skillLibrary->all(withoutGet: true);
            return DataTables::eloquent($data)
                ->rawColumns([])
                ->toJson();
        }
        return view('client.skills.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skill = new Skill();
        return view('client.skills.create', compact('skill'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillRequest $request)
    {
        $this->skillLibrary->save($request->validated());
        return redirect()->route('clients.skills.index')->with('success', 'Skill created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $skill = $this->skillLibrary->getByID($id);
        return view('client.skills.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SkillRequest $request, $id)
    {
        $this->skillLibrary->save($request->validated(), $this->skillLibrary->getByID($id));
        return redirect()->route('clients.skills.index')->with('success', 'Skill updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->skillLibrary->deleteByID($id);
        return response()->json([
            'status' => true,
            'message' => 'Skill deleted successfully'
        ]);
    }
}
