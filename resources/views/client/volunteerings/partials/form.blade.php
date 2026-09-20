@csrf
<div class="row">

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.organization') }}</label>
  <input type="text" name="organization" class="form-control @error('organization') is-invalid @enderror" value="{{ old('organization', $volunteering->organization) }}">
  @error('organization')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.role') }}</label>
  <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role', $volunteering->role) }}">
  @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.start_date') }}</label>
  <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
    value="{{ old('start_date', $volunteering->start_date ? \Carbon\Carbon::parse($volunteering->start_date)->format('Y-m-d') : '') }}">
  @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.end_date') }}</label>
  <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
    value="{{ old('end_date', $volunteering->end_date ? \Carbon\Carbon::parse($volunteering->end_date)->format('Y-m-d') : '') }}">
  @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-12 mb-3">
  <label class="form-label">{{ __('validation.attributes.description') }}</label>
  <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $volunteering->description) }}</textarea>
  @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-12 mt-3">
  <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
  <a href="{{ route('clients.volunteerings.index') }}" class="btn btn-label-secondary">{{ __('app.cancel') }}</a>
</div>
</div>
