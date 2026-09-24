<?php

namespace App\Console\Commands;

use App\Services\GoogleDriveCvService;
use Illuminate\Console\Command;

class AuthorizeGoogleDriveCommand extends Command
{
    protected $signature = 'drive:authorize {--code= : Authorization code from Google}';

    protected $description = 'Authorize Google Drive OAuth and print a refresh token for .env';

    public function handle(GoogleDriveCvService $drive): int
    {
        if (! filled(config('services.google_drive.client_id')) || ! filled(config('services.google_drive.client_secret'))) {
            $this->error('Set GOOGLE_DRIVE_CLIENT_ID and GOOGLE_DRIVE_CLIENT_SECRET in .env first.');

            return self::FAILURE;
        }

        $client = $drive->makeOAuthClient();
        $code = $this->option('code');

        if (! $code) {
            $authUrl = $client->createAuthUrl();
            $this->info('1) Open this URL in your browser and approve access:');
            $this->line($authUrl);
            $this->newLine();
            $this->info('2) Copy the ?code= value from the redirect URL, then run:');
            $this->line('   php artisan drive:authorize --code=PASTE_CODE_HERE');

            return self::SUCCESS;
        }

        $token = $client->fetchAccessTokenWithAuthCode($code);

        if (isset($token['error'])) {
            $this->error('Authorization failed: '.($token['error_description'] ?? $token['error']));

            return self::FAILURE;
        }

        $refresh = $token['refresh_token'] ?? null;

        if (! $refresh) {
            $this->error('No refresh_token returned. Revoke app access at https://myaccount.google.com/permissions and try again (prompt=consent).');

            return self::FAILURE;
        }

        $this->newLine();
        $this->info('Add this to your .env file:');
        $this->line('GOOGLE_DRIVE_REFRESH_TOKEN='.$refresh);
        $this->newLine();
        $this->comment('You can keep GOOGLE_DRIVE_FOLDER_ID as your personal Drive folder ID.');

        return self::SUCCESS;
    }
}
