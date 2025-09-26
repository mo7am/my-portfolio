<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\LinkRequest;
use App\Libraries\LinkLibrary;
use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LinkController extends Controller
{
    public function __construct(
        protected readonly LinkLibrary $linkLibrary
    ) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->linkLibrary->all(withoutGet: true);
    
            return DataTables::eloquent($data)
                ->editColumn('icon', function ($row) {
                    if (!$row->icon) return '';
                    return '<i style="font-size:25px" class="' . e($row->icon) . '"></i>';
                })
                ->editColumn('color', function ($row) {
                    if (!$row->color) return '';
                    return '<span style="display:inline-block;width:25px;height:25px;border-radius:50%;background-color:' 
                           . e($row->color) . ';border:1px solid #E0E0E0"></span>';
                })
                ->rawColumns(['icon', 'color'])
                ->toJson();
        }
        return view('client.links.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $link = new Link();
        return view('client.links.create', compact('link'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkRequest $request)
    {
        $this->linkLibrary->save($request->validated());
        return redirect()->route('clients.links.index')->with('success', 'Link created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = $this->linkLibrary->getByID($id);
        return view('client.links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinkRequest $request, $id)
    {
        $this->linkLibrary->save($request->validated(), $this->linkLibrary->getByID($id));
        return redirect()->route('clients.links.index')->with('success', 'Link updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->linkLibrary->deleteByID($id);
        return response()->json([
            'status' => true,
            'message' => 'Link deleted successfully'
        ]);
    }
}
