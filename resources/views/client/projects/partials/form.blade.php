<div class="row">
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.title') }}</label>
    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title', $project->title) }}">
    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-3">
    <label class="form-label">{{ __('validation.attributes.role') }}</label>
    <input class="form-control @error('role') is-invalid @enderror" type="text" name="role" value="{{ old('role', $project->role) }}">
    @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-3">
    <label class="form-label">{{ __('validation.attributes.type') }}</label>
    <select class="form-select @error('type') is-invalid @enderror" name="type">
      @php $ptype = old('type', $project->type); @endphp
      <option value="">—</option>
      <option value="project" @selected($ptype==='project')>{{ __('cv.project_type.project') }}</option>
      <option value="case_study" @selected($ptype==='case_study')>{{ __('cv.project_type.case_study') }}</option>
      <option value="design" @selected($ptype==='design')>{{ __('cv.project_type.design') }}</option>
      <option value="publication" @selected($ptype==='publication')>{{ __('cv.project_type.publication') }}</option>
      <option value="campaign" @selected($ptype==='campaign')>{{ __('cv.project_type.campaign') }}</option>
      <option value="other" @selected($ptype==='other')>{{ __('cv.project_type.other') }}</option>
    </select>
    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.date') }}</label>
    <input class="form-control @error('date') is-invalid @enderror" type="date" name="date" value="{{ old('date', optional($project->date)->format('Y-m-d')) }}">
    @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.project_work_id') }}</label>
    <select
      name="project_work_id"
      class="select2 form-select @error('project_work_id') is-invalid @enderror"
      data-allow-clear="true"
      data-placeholder="{{ __('app.no_selection') }}"
    >
      <option value=""></option>
      @foreach ($projectGroups as $projectGroup)
        <option value="{{ $projectGroup->id }}" @selected((string) old('project_work_id', $project->project_work_id) === (string) $projectGroup->id)>{{ $projectGroup->project_work }}</option>
      @endforeach
    </select>
    <div class="form-text">{{ __('app.clear_selection_hint') }}</div>
    @error('project_work_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-12">
    <label class="form-label">{{ __('validation.attributes.description') }}</label>
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4">{{ old('description', $project->description) }}</textarea>
    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.source_code') }}</label>
    <input class="form-control @error('source_code') is-invalid @enderror" type="url" name="source_code" value="{{ old('source_code', $project->source_code) }}">
    @error('source_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.website_url') }}</label>
    <input class="form-control @error('website_url') is-invalid @enderror" type="url" name="website_url" value="{{ old('website_url', $project->website_url) }}">
    @error('website_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('validation.attributes.other') }}</label>
    <input class="form-control @error('other') is-invalid @enderror" type="text" name="other" value="{{ old('other', $project->other) }}">
    @error('other')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-12">
    <label class="form-label">{{ __('validation.attributes.tags') }}</label>
    <input class="form-control @error('tags') is-invalid @enderror" type="text" id="TagifyBasic" name="tags" value="{{ old('tags', json_encode($project->tags ?? [])) }}">
    @error('tags')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>
