<div class="row">
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.skill') }}</label>
    <input class="form-control @error('skill') is-invalid @enderror" type="text" name="skill" value="{{ old('skill', $skill->skill) }}">
    @error('skill')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-3">
    <label class="form-label">{{ __('validation.attributes.level') }}</label>
    <input class="form-control @error('level') is-invalid @enderror" type="text" name="level" value="{{ old('level', $skill->level) }}" placeholder="Beginner / Intermediate / Expert">
    @error('level')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-3">
    <label class="form-label">{{ __('validation.attributes.category') }}</label>
    <select class="form-select @error('category') is-invalid @enderror" name="category">
      @php $cat = old('category', $skill->category); @endphp
      <option value="">—</option>
      <option value="technical" @selected($cat==='technical')>{{ __('cv.skill_category.technical') }}</option>
      <option value="soft" @selected($cat==='soft')>{{ __('cv.skill_category.soft') }}</option>
      <option value="tool" @selected($cat==='tool')>{{ __('cv.skill_category.tool') }}</option>
      <option value="domain" @selected($cat==='domain')>{{ __('cv.skill_category.domain') }}</option>
    </select>
    @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>
