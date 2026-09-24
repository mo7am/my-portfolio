<?php

namespace App\Http\Controllers;

use App\Services\GoogleDriveCvService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DriveOAuthController extends Controller
{
    public function redirect(GoogleDriveCvService $drive): RedirectResponse
    {
        if (! filled(config('services.google_drive.client_id')) || ! filled(config('services.google_drive.client_secret'))) {
            abort(503, 'Set GOOGLE_DRIVE_CLIENT_ID and GOOGLE_DRIVE_CLIENT_SECRET in .env first.');
        }

        $client = $drive->makeOAuthClient();

        return redirect()->away($client->createAuthUrl());
    }

    public function callback(Request $request, GoogleDriveCvService $drive): View
    {
        if ($request->filled('error')) {
            return view('drive.oauth-result', [
                'success' => false,
                'message' => 'Google authorization was denied: '.$request->string('error'),
                'refreshToken' => null,
            ]);
        }

        $code = $request->string('code')->toString();

        if ($code === '') {
            return view('drive.oauth-result', [
                'success' => false,
                'message' => 'Missing authorization code from Google.',
                'refreshToken' => null,
            ]);
        }

        $client = $drive->makeOAuthClient();
        $token = $client->fetchAccessTokenWithAuthCode($code);

        if (isset($token['error'])) {
            return view('drive.oauth-result', [
                'success' => false,
                'message' => 'Authorization failed: '.($token['error_description'] ?? $token['error']),
                'refreshToken' => null,
            ]);
        }

        $refresh = $token['refresh_token'] ?? null;

        if (! $refresh) {
            return view('drive.oauth-result', [
                'success' => false,
                'message' => 'No refresh_token returned. Revoke app access at https://myaccount.google.com/permissions then try again.',
                'refreshToken' => null,
            ]);
        }

        return view('drive.oauth-result', [
            'success' => true,
            'message' => 'Copy this refresh token into your .env as GOOGLE_DRIVE_REFRESH_TOKEN, then run: php artisan config:clear',
            'refreshToken' => $refresh,
        ]);
    }
}
