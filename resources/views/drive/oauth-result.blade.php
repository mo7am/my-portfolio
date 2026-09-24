<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Google Drive OAuth</title>
  <style>
    body { font-family: system-ui, sans-serif; max-width: 720px; margin: 3rem auto; padding: 0 1rem; line-height: 1.5; }
    .ok { color: #0a7a34; }
    .err { color: #b42318; }
    textarea { width: 100%; min-height: 96px; font-family: ui-monospace, monospace; font-size: 13px; padding: .75rem; }
    code { background: #f3f4f6; padding: .15rem .35rem; border-radius: 4px; }
  </style>
</head>
<body>
  <h1 class="{{ $success ? 'ok' : 'err' }}">
    {{ $success ? 'Google Drive connected' : 'Google Drive authorization failed' }}
  </h1>
  <p>{{ $message }}</p>

  @if ($success && $refreshToken)
    <p><strong>Add this line to <code>.env</code>:</strong></p>
    <textarea readonly onclick="this.select()">GOOGLE_DRIVE_REFRESH_TOKEN={{ $refreshToken }}</textarea>
    <p>Then run <code>php artisan config:clear</code> and try <strong>Upload to Google Drive</strong> on the resume page again.</p>
  @else
    <p>
      Start again:
      <a href="{{ route('drive.oauth.redirect') }}">{{ url('/drive/oauth/redirect') }}</a>
    </p>
  @endif
</body>
</html>
