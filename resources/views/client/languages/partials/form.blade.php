<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="mb-3 col-sm-12">
                <label for="language" class="form-label">Language</label>
                <input class="form-control @error('language') is-invalid @enderror" type="text" id="language" name="language" value="{{old('language', $language->language)}}" placeholder="Enter language" />
                  @error('language')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
            <div class="mb-3 col-sm-12">
                <label for="description" class="form-label">Description</label>
                <input class="form-control @error('description') is-invalid @enderror" type="text" id="description" name="description" value="{{old('description', $language->description)}}" placeholder="Enter description" />
                  @error('description')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
        </div>
    </div>
</div>
