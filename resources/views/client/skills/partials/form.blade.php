<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="mb-3 col-sm-12">
                <label for="skill" class="form-label">Skill</label>
                <input class="form-control @error('skill') is-invalid @enderror" type="text" id="skill" name="skill" value="{{old('skill', $skill->skill)}}" placeholder="Enter skill" />
                  @error('skill')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
        </div>
    </div>
</div>
