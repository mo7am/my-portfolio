@csrf
<div class="row">

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.title') }}</label>
  <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $course->title) }}">
  @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.provider') }}</label>
  <input type="text" name="provider" class="form-control @error('provider') is-invalid @enderror" value="{{ old('provider', $course->provider) }}">
  @error('provider')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.start_date') }}</label>
  <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
    value="{{ old('start_date', $course->start_date ? \Carbon\Carbon::parse($course->start_date)->format('Y-m-d') : '') }}">
  @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6 mb-3">
  <label class="form-label">{{ __('validation.attributes.end_date') }}</label>
  <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
    value="{{ old('end_date', $course->end_date ? \Carbon\Carbon::parse($course->end_date)->format('Y-m-d') : '') }}">
  @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-12 mb-3">
  <label class="form-label">{{ __('validation.attributes.description') }}</label>
  <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $course->description) }}</textarea>
  @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-12 mt-3">
  <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
  <a href="{{ route('clients.courses.index') }}" class="btn btn-label-secondary">{{ __('app.cancel') }}</a>
</div>
</div>
