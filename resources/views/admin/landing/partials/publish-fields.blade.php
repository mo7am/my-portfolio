<div class="row">
  <div class="mb-3 col-md-4">
    <label class="form-label">{{ __('dashboard.sort_order') }}</label>
    <input class="form-control @error('sort_order') is-invalid @enderror" type="number" min="0" name="sort_order" value="{{ old('sort_order', $sortOrder ?? 0) }}">
    @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-4 d-flex align-items-end">
    <div class="form-check form-switch mb-2">
      <input class="form-check-input" type="checkbox" name="is_published" value="1" id="is_published" @checked(old('is_published', $isPublished ?? true))>
      <label class="form-check-label" for="is_published">{{ __('dashboard.published') }}</label>
    </div>
  </div>
</div>
