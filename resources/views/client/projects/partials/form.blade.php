<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="mb-3 col-sm-6">
                <label for="title" class="form-label">Title</label>
                <input class="form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" value="{{old('title', $project->title)}}" placeholder="Enter title" />
                  @error('title')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
            <div class="mb-3 col-sm-6">
                <label for="date" class="form-label">Date</label>
                <input class="form-control @error('date') is-invalid @enderror" type="date" id="date" name="date" value="{{ old('date', optional($project->date)->format('Y-m-d')) }}" placeholder="YYYY-MM-DD" />
                  @error('date')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
            <div class="mb-3 col-sm-12">
                <label for="description" class="form-label">Description</label>
                <input class="form-control @error('description') is-invalid @enderror" type="text" id="description" name="description" value="{{old('description', $project->description)}}" placeholder="Enter description" />
                  @error('description')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label" for="select2Basic">Project Group</label>
                <select name="project_work_id" id="select2Basic" class="select2 form-select form-select-lg @error('project_work_id') is-invalid @enderror" data-allow-clear="true">
                    @foreach ($projectGroups as $projectGroup)
                        <option value="{{ $projectGroup->id }}" {{ old('project_work_id', $project->project_work_id) == $projectGroup->id ? 'selected' : '' }}>
                            {{ $projectGroup->project_work }}
                        </option>
                    @endforeach
                </select>
                @error('project_work_id')
                    <div class="invalid-feedback text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-sm-6">
                <label for="source_code" class="form-label">Source Code</label>
                <input class="form-control @error('source_code') is-invalid @enderror" type="text" id="source_code" name="source_code" value="{{old('source_code', $project->source_code)}}" placeholder="Enter source code" />
                  @error('source_code')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
            <div class="mb-3 col-sm-6">
                <label for="website_url" class="form-label">Website Url</label>
                <input class="form-control @error('website_url') is-invalid @enderror" type="text" id="website_url" name="website_url" value="{{old('website_url', $project->website_url)}}" placeholder="Enter website url" />
                  @error('website_url')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
            <div class="mb-3 col-sm-6">
                <label for="other" class="form-label">Other</label>
                <input class="form-control @error('other') is-invalid @enderror" type="text" id="other" name="other" value="{{old('other', $project->other)}}" placeholder="Enter other" />
                  @error('other')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
            <div class="mb-3 col-sm-12">
                <label for="TagifyBasic" class="form-label">Tags</label>
                <input class="form-control @error('tags') is-invalid @enderror" type="text" id="TagifyBasic" name="tags" value="{{old('tags', json_encode($project->tags))}}" placeholder="Enter tags" />
                  @error('tags')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
        </div>
    </div>
</div>

@section('scripts')
 <script>
    $(document).ready(function(){
        // Flat Picker
        $('#date').flatpickr({
            monthSelectorType: 'static',
        });
    });
    </script>
@endsection
