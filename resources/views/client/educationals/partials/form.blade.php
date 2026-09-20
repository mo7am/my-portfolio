<div class="row">
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.educational') }}</label>
    <input class="form-control @error('educational') is-invalid @enderror" type="text" name="educational" value="{{ old('educational', $educational->educational) }}">
    @error('educational')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.institution') }}</label>
    <input class="form-control @error('institution') is-invalid @enderror" type="text" name="institution" value="{{ old('institution', $educational->institution) }}">
    @error('institution')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.degree') }}</label>
    <input class="form-control @error('degree') is-invalid @enderror" type="text" name="degree" value="{{ old('degree', $educational->degree) }}">
    @error('degree')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.field') }}</label>
    <input class="form-control @error('field') is-invalid @enderror" type="text" name="field" value="{{ old('field', $educational->field) }}">
    @error('field')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.location') }}</label>
    <input class="form-control @error('location') is-invalid @enderror" type="text" name="location" value="{{ old('location', $educational->location) }}">
    @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.gpa') }}</label>
    <input class="form-control @error('gpa') is-invalid @enderror" type="text" name="gpa" value="{{ old('gpa', $educational->gpa) }}">
    @error('gpa')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.start_date') }}</label>
    <input class="form-control @error('start_date') is-invalid @enderror" type="date" name="start_date" value="{{ old('start_date', optional($educational->start_date)->format('Y-m-d')) }}">
    @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.end_date') }}</label>
    <input class="form-control @error('end_date') is-invalid @enderror" type="date" name="end_date" value="{{ old('end_date', optional($educational->end_date)->format('Y-m-d')) }}">
    @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>
