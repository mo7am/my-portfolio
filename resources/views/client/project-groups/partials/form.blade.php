<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="mb-3 col-sm-12">
                <label for="project_work" class="form-label">Project Group</label>
                <input class="form-control @error('project_work') is-invalid @enderror" type="text" id="project_work" name="project_work" value="{{old('project_work', $projectGroup->project_work)}}" placeholder="Enter project group" />
                  @error('project_work')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
        </div>
    </div>
</div>
