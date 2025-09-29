<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Libraries\TenantLibrary;
use App\Libraries\UserLibrary;
use App\Models\Tenant;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = DB::transaction(function () use ($request) {
            /** @var Tenant $tenant */
            $tenant = app(TenantLibrary::class)->save(['name' => $request->first_name . ' ' . $request->second_name]);

            $user = app(UserLibrary::class)->save(array_merge(
                $request->safe()->only('first_name', 'second_name', 'email'),
                [
                    'password' => Hash::make($request->password),
                    'type' => UserType::CLIENT->value,
                    'tenant_id' => $tenant->id,
                    'domain' => strtolower($request->first_name) . '-' . strtolower($request->second_name).'-'.$tenant->id,
                ]
            ));

            return $user;
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended(route('clients.index'))->with('success', 'Signed up successfully');
    }
}
