<div class="row">
  <div class="mb-3 col-12">
    <label class="form-label">{{ __('dashboard.quote') }}</label>
    <textarea class="form-control @error('quote') is-invalid @enderror" name="quote" rows="4">{{ old('quote', $testimonial->quote) }}</textarea>
    @error('quote')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('dashboard.name') }}</label>
    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name', $testimonial->name) }}">
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('dashboard.role') }}</label>
    <input class="form-control @error('role') is-invalid @enderror" type="text" name="role" value="{{ old('role', $testimonial->role) }}">
    @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('dashboard.photo') }}</label>
    <input class="form-control @error('photo') is-invalid @enderror" type="file" name="photo" accept="image/*">
    @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
    @if($testimonial->exists && $testimonial->photoUrl())
      <img src="{{ $testimonial->photoUrl() }}" alt="" class="rounded mt-2" style="width:64px;height:64px;object-fit:cover">
    @endif
  </div>
</div>
@include('admin.landing.partials.publish-fields', ['sortOrder' => $testimonial->sort_order, 'isPublished' => $testimonial->is_published])
