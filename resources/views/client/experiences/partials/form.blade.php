<div class="row">
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.title') }}</label>
    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title', $experience->title) }}">
    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.company') }}</label>
    <input class="form-control @error('company') is-invalid @enderror" type="text" name="company" value="{{ old('company', $experience->company) }}">
    @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.location') }}</label>
    <input class="form-control @error('location') is-invalid @enderror" type="text" name="location" value="{{ old('location', $experience->location) }}">
    @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.employment_type') }}</label>
    <select class="form-select @error('employment_type') is-invalid @enderror" name="employment_type">
      @php $type = old('employment_type', $experience->employment_type); @endphp
      <option value="">—</option>
      <option value="full_time" @selected($type==='full_time')>{{ __('cv.employment.full_time') }}</option>
      <option value="part_time" @selected($type==='part_time')>{{ __('cv.employment.part_time') }}</option>
      <option value="contract" @selected($type==='contract')>{{ __('cv.employment.contract') }}</option>
      <option value="freelance" @selected($type==='freelance')>{{ __('cv.employment.freelance') }}</option>
      <option value="internship" @selected($type==='internship')>{{ __('cv.employment.internship') }}</option>
    </select>
    @error('employment_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-12">
    <label class="form-label">{{ __('validation.attributes.description') }}</label>
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4">{{ old('description', $experience->description) }}</textarea>
    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.start_date') }}</label>
    <input class="form-control @error('start_date') is-invalid @enderror" type="date" name="start_date" value="{{ old('start_date', optional($experience->start_date)->format('Y-m-d')) }}">
    @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.end_date') }} <small class="text-muted">({{ __('app.present') }})</small></label>
    <input class="form-control @error('end_date') is-invalid @enderror" type="date" name="end_date" value="{{ old('end_date', optional($experience->end_date)->format('Y-m-d')) }}">
    @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>
