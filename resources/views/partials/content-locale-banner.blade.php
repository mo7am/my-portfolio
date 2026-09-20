@if(auth('sanctum')->check() && auth('sanctum')->user()?->type === \App\Enums\UserType::CLIENT->value)
  <div class="alert alert-primary d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4" role="status">
    <div class="d-flex align-items-center gap-2">
      <i class="ti ti-file-text ti-sm"></i>
      <div>
        <strong>{{ __('app.cv_language') }}:</strong>
        <span class="ms-1">{{ content_locale_label() }}</span>
        <span class="text-muted small d-block d-md-inline ms-md-2">{{ __('app.cv_language_hint') }}</span>
      </div>
    </div>
    <div class="btn-group btn-group-sm" role="group" aria-label="{{ __('app.cv_language') }}">
      @foreach(\App\Support\ContentLocale::supported() as $code)
        <a
          href="{{ route('content-locale.switch', $code) }}"
          class="btn {{ content_locale() === $code ? 'btn-primary' : 'btn-outline-primary' }}"
        >{{ \App\Support\ContentLocale::label($code) }}</a>
      @endforeach
    </div>
  </div>
@endif
