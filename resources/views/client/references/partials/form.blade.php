@csrf
<div class="row">

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.name') }}</label>
  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $reference->name) }}">
  @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.position') }}</label>
  <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', $reference->position) }}">
  @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.company') }}</label>
  <input type="text" name="company" class="form-control @error('company') is-invalid @enderror" value="{{ old('company', $reference->company) }}">
  @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.email') }}</label>
  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $reference->email) }}">
  @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.phone') }}</label>
  <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $reference->phone) }}">
  @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-12 mb-3">
  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" name="is_public" value="1" id="is_public" @checked(old('is_public', $reference->is_public ?? true))>
    <label class="form-check-label" for="is_public">{{ __('dashboard.show_publicly') }}</label>
  </div>
</div>
<div class="col-12 mt-3">
  <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
  <a href="{{ route('clients.references.index') }}" class="btn btn-label-secondary">{{ __('app.cancel') }}</a>
</div>
</div>
