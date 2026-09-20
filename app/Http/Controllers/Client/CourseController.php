<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Libraries\CourseLibrary;
use App\Models\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller
{
    public function __construct(
        protected readonly CourseLibrary $courseLibrary
    ) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->courseLibrary->all(withoutGet: true);

            return DataTables::eloquent($data)->rawColumns([])->toJson();
        }

        return view('client.courses.index');
    }

    public function create()
    {
        $course = new Course;

        return view('client.courses.create', compact('course'));
    }

    public function store(CourseRequest $request)
    {
        $this->courseLibrary->save($request->validated());

        return redirect()->route('clients.courses.index')->with('success', __('messages.created', ['item' => __('dashboard.course')]));
    }

    public function edit($id)
    {
        $course = $this->courseLibrary->getByID($id);

        return view('client.courses.edit', compact('course'));
    }

    public function update(CourseRequest $request, $id)
    {
        $this->courseLibrary->save($request->validated(), $this->courseLibrary->getByID($id));

        return redirect()->route('clients.courses.index')->with('success', __('messages.updated', ['item' => __('dashboard.course')]));
    }

    public function destroy($id)
    {
        $this->courseLibrary->deleteByID($id);

        return response()->json([
            'status' => true,
            'message' => __('messages.deleted', ['item' => __('dashboard.course')]),
        ]);
    }
}
