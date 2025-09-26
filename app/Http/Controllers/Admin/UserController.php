<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Libraries\TenantLibrary;
use App\Libraries\UserLibrary;
use App\Models\Tenant;
use App\Models\User;
use App\Notifications\WelcomeOnBoardNotification;
use App\Service\GeneratePasswordService;
use App\Support\Filters\UserFilter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct(
        protected readonly UserLibrary $userLibrary,
        protected readonly TenantLibrary $tenantLibrary
    ) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->userLibrary->all(filter: new UserFilter(['type' => UserType::CLIENT->value]), withoutGet: true);
            return DataTables::eloquent($data)
                ->addColumn('logo', function ($data) {
                    $logoUrl = $data->getFirstMediaUrl('logo');
                    return '<img src="' . $logoUrl . '" alt="logo" style="width:40px; height:40px; border-radius:50%; object-fit:cover;">';
                })
                ->addColumn('portfolio_link', function ($user) {
                    return '<a href="' . $user->portfolio_link . '" target="_blank" style="color: #2196f3; text-decoration: underline;">
                                '.$user->portfolio_link .'
                            </a>';
                })
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('created_at', function ($user) {
                    return Carbon::parse($user->created_at)->format('F Y'); // September 2025
                })
                
                ->filterColumn('created_at', function ($query, $keyword) {
                    $query->whereRaw("DATE_FORMAT(created_at, '%M %Y') like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('name', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(first_name, ' ', second_name, ' ', third_name) like ?", ["%{$keyword}%"]);
                })

                ->orderColumn('name', function ($query, $order) {
                    $query->orderByRaw("CONCAT(first_name, ' ', second_name, ' ', third_name) {$order}");
                })
                ->orderColumn('created_at', function ($query, $order) {
                    $query->orderByRaw("YEAR(created_at) {$order}, MONTH(created_at) {$order}");
                })
                
                ->rawColumns(['created_at', 'logo', 'name', 'portfolio_link'])
                ->toJson();
        }
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('admin.users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $password = GeneratePasswordService::generate();
        $user = DB::transaction(function () use ($request, $password) {
            /** @var Tenant $tenant */
            $tenant = $this->tenantLibrary->save(['name' => $request->first_name . ' ' . $request->second_name]);
            /** @var User $user */
            $user = $this->userLibrary->save(array_merge(
                $request->safe()->only('first_name', 'second_name', 'third_name', 'email', 'phone', 'address'),
                [
                    'password' => Hash::make($password),
                    'type' => UserType::CLIENT->value,
                    'tenant_id' => $tenant->id,
                    'domain' => $request->first_name . '-' . $request->second_name.'-'.$tenant->id,
                ]
            ));

            return $user;
        });

        $user->notify(new WelcomeOnBoardNotification($password));
        return redirect()->route('admins.users.index')->with('success', 'User created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userLibrary->getByID($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $this->userLibrary->save($request->validated(), $this->userLibrary->getByID($id));
        return redirect()->route('admins.users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userLibrary->deleteByID($id);
        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully'
        ]);
    }
}
