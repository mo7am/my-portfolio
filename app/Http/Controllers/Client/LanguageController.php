<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Libraries\LanguageLibrary;
use App\Models\Language;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LanguageController extends Controller
{
    public function __construct(
        protected readonly LanguageLibrary $languageLibrary
    ) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->languageLibrary->all(withoutGet: true);
            return DataTables::eloquent($data)
                ->rawColumns([])
                ->toJson();
        }
        return view('client.languages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = new Language();
        return view('client.languages.create', compact('language'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageRequest $request)
    {
        $this->languageLibrary->save($request->validated());
        return redirect()->route('clients.languages.index')->with('success', 'Language created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = $this->languageLibrary->getByID($id);
        return view('client.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageRequest $request, $id)
    {
        $this->languageLibrary->save($request->validated(), $this->languageLibrary->getByID($id));
        return redirect()->route('clients.languages.index')->with('success', 'Language updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->languageLibrary->deleteByID($id);
        return response()->json([
            'status' => true,
            'message' => 'Language deleted successfully'
        ]);
    }
}
