@csrf
<div class="row">

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.title') }}</label>
  <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $certification->title) }}">
  @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.issuer') }}</label>
  <input type="text" name="issuer" class="form-control @error('issuer') is-invalid @enderror" value="{{ old('issuer', $certification->issuer) }}">
  @error('issuer')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.issued_at') }}</label>
  <input type="date" name="issued_at" class="form-control @error('issued_at') is-invalid @enderror"
    value="{{ old('issued_at', $certification->issued_at ? \Carbon\Carbon::parse($certification->issued_at)->format('Y-m-d') : '') }}">
  @error('issued_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.expires_at') }}</label>
  <input type="date" name="expires_at" class="form-control @error('expires_at') is-invalid @enderror"
    value="{{ old('expires_at', $certification->expires_at ? \Carbon\Carbon::parse($certification->expires_at)->format('Y-m-d') : '') }}">
  @error('expires_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.credential_id') }}</label>
  <input type="text" name="credential_id" class="form-control @error('credential_id') is-invalid @enderror" value="{{ old('credential_id', $certification->credential_id) }}">
  @error('credential_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.url') }}</label>
  <input type="url" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url', $certification->url) }}">
  @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-12 mt-3">
  <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
  <a href="{{ route('clients.certifications.index') }}" class="btn btn-label-secondary">{{ __('app.cancel') }}</a>
</div>
</div>
