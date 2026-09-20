@csrf
<div class="row">

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.title') }}</label>
  <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $award->title) }}">
  @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.issuer') }}</label>
  <input type="text" name="issuer" class="form-control @error('issuer') is-invalid @enderror" value="{{ old('issuer', $award->issuer) }}">
  @error('issuer')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.awarded_at') }}</label>
  <input type="date" name="awarded_at" class="form-control @error('awarded_at') is-invalid @enderror"
    value="{{ old('awarded_at', $award->awarded_at ? \Carbon\Carbon::parse($award->awarded_at)->format('Y-m-d') : '') }}">
  @error('awarded_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-12 mb-3">
  <label class="form-label">{{ __('validation.attributes.description') }}</label>
  <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $award->description) }}</textarea>
  @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-12 mt-3">
  <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
  <a href="{{ route('clients.awards.index') }}" class="btn btn-label-secondary">{{ __('app.cancel') }}</a>
</div>
</div>
