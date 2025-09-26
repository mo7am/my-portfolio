<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\TenantRequest;
use App\Libraries\TenantLibrary;

class TenantController extends Controller
{
    public function __construct(
        protected readonly TenantLibrary $tenantLibrary
    ) {}

    public function show()
    {
        $tenant = auth('sanctum')->user()->tenant;
        return view('client.settings.show', compact('tenant'));
    }

    public function update(TenantRequest $request)
    {
        $this->tenantLibrary->store($request->validated(), auth('sanctum')->user()->tenant->id);
        return redirect()->back()->with('success', 'Settings updated successfully');
    }
}
