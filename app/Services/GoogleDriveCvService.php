<?php

namespace App\Services;

use Google\Client as GoogleClient;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class GoogleDriveCvService
{
    public function isConfigured(): bool
    {
        return $this->usesOAuth() || $this->usesServiceAccount();
    }

    public function usesOAuth(): bool
    {
        return filled(config('services.google_drive.client_id'))
            && filled(config('services.google_drive.client_secret'))
            && filled(config('services.google_drive.refresh_token'));
    }

    public function usesServiceAccount(): bool
    {
        $path = config('services.google_drive.credentials');

        return is_string($path) && $path !== '' && is_file($path);
    }

    /**
     * Upload (or replace) a CV PDF and return a public shareable link.
     *
     * @return array{file_id: string, link: string}
     */
    public function uploadCvPdf(string $pdfBinary, string $fileName, ?string $existingFileId = null): array
    {
        if (! $this->isConfigured()) {
            throw new RuntimeException('Google Drive is not configured.');
        }

        $drive = $this->drive();
        $folderId = config('services.google_drive.folder_id') ?: null;

        $meta = new DriveFile([
            'name' => $fileName,
            'mimeType' => 'application/pdf',
        ]);

        if ($folderId && ! $existingFileId) {
            $meta->setParents([$folderId]);
        }

        $options = [
            'data' => $pdfBinary,
            'mimeType' => 'application/pdf',
            'uploadType' => 'multipart',
            'fields' => 'id, webViewLink, webContentLink',
            'supportsAllDrives' => true,
        ];

        try {
            if ($existingFileId) {
                $file = $drive->files->update($existingFileId, $meta, $options);
            } else {
                $file = $drive->files->create($meta, $options);
            }
        } catch (\Throwable $e) {
            if ($this->isServiceAccountQuotaError($e)) {
                throw new RuntimeException(
                    'Service accounts cannot store files in personal Google Drive. '
                    .'Configure OAuth (GOOGLE_DRIVE_CLIENT_ID / CLIENT_SECRET / REFRESH_TOKEN) '
                    .'or use a Shared Drive folder with the service account as Content Manager.',
                    previous: $e
                );
            }

            if ($existingFileId) {
                Log::warning('Google Drive CV update failed; creating new file.', [
                    'file_id' => $existingFileId,
                    'error' => $e->getMessage(),
                ]);

                if ($folderId) {
                    $meta->setParents([$folderId]);
                }

                try {
                    $file = $drive->files->create($meta, $options);
                } catch (\Throwable $createError) {
                    if ($this->isServiceAccountQuotaError($createError)) {
                        throw new RuntimeException(
                            'Service accounts cannot store files in personal Google Drive. '
                            .'Configure OAuth (GOOGLE_DRIVE_CLIENT_ID / CLIENT_SECRET / REFRESH_TOKEN) '
                            .'or use a Shared Drive folder with the service account as Content Manager.',
                            previous: $createError
                        );
                    }
                    throw $createError;
                }
            } else {
                throw $e;
            }
        }

        $this->ensurePublicReadable($drive, $file->getId());

        $link = $file->getWebViewLink()
            ?: 'https://drive.google.com/file/d/'.$file->getId().'/view';

        return [
            'file_id' => $file->getId(),
            'link' => $link,
        ];
    }

    public function makeOAuthClient(): GoogleClient
    {
        $client = new GoogleClient;
        $client->setClientId((string) config('services.google_drive.client_id'));
        $client->setClientSecret((string) config('services.google_drive.client_secret'));
        $client->setRedirectUri((string) config('services.google_drive.redirect_uri'));
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        $client->setScopes([Drive::DRIVE_FILE]);
        $client->setApplicationName(config('app.name', 'Portfolio'));

        return $client;
    }

    protected function drive(): Drive
    {
        $client = new GoogleClient;
        $client->setApplicationName(config('app.name', 'Portfolio'));
        $client->setScopes([Drive::DRIVE_FILE]);

        if ($this->usesOAuth()) {
            $client->setClientId((string) config('services.google_drive.client_id'));
            $client->setClientSecret((string) config('services.google_drive.client_secret'));
            $token = $client->fetchAccessTokenWithRefreshToken(
                (string) config('services.google_drive.refresh_token')
            );

            if (isset($token['error'])) {
                throw new RuntimeException('Google OAuth refresh failed: '.($token['error_description'] ?? $token['error']));
            }
        } else {
            $client->setAuthConfig((string) config('services.google_drive.credentials'));
        }

        return new Drive($client);
    }

    protected function ensurePublicReadable(Drive $drive, string $fileId): void
    {
        try {
            $permission = new Permission([
                'type' => 'anyone',
                'role' => 'reader',
            ]);
            $drive->permissions->create($fileId, $permission, [
                'supportsAllDrives' => true,
            ]);
        } catch (\Throwable $e) {
            Log::debug('Google Drive permission create skipped/failed: '.$e->getMessage());
        }
    }

    protected function isServiceAccountQuotaError(\Throwable $e): bool
    {
        $message = $e->getMessage();

        return str_contains($message, 'Service Accounts do not have storage quota')
            || str_contains($message, 'storageQuotaExceeded');
    }
}
