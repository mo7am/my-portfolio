<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebsiteRequest;
use App\Libraries\WebsiteLibrary;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WebsiteController extends Controller
{
    public function __construct(
        protected readonly WebsiteLibrary $websiteLibrary
    ) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->websiteLibrary->all(withoutGet: true);
            return DataTables::eloquent($data)
                ->addColumn('url', function ($data) {
                    return '<a href="' . $data->url . '" target="_blank" style="color: #2196f3; text-decoration: underline;">
                                '.$data->url .'
                            </a>';
                })
                ->rawColumns(['url'])
                ->toJson();
        }
        return view('client.websites.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $website = new Website();
        return view('client.websites.create', compact('website'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WebsiteRequest $request)
    {
        $this->websiteLibrary->save($request->validated());
        return redirect()->route('clients.websites.index')->with('success', 'Website created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $website = $this->websiteLibrary->getByID($id);
        return view('client.websites.edit', compact('website'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WebsiteRequest $request, $id)
    {
        $this->websiteLibrary->save($request->validated(), $this->websiteLibrary->getByID($id));
        return redirect()->route('clients.websites.index')->with('success', 'Website updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->websiteLibrary->deleteByID($id);
        return response()->json([
            'status' => true,
            'message' => 'Website deleted successfully'
        ]);
    }
}
