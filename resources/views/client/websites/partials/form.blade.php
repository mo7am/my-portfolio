<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="mb-3 col-sm-12">
                <label for="name" class="form-label">Name</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{old('name', $website->name)}}" placeholder="Enter name" />
                  @error('name')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
            <div class="mb-3 col-sm-12">
                <label for="url" class="form-label">Url</label>
                <input class="form-control @error('url') is-invalid @enderror" type="text" id="url" name="url" value="{{old('url', $website->url)}}" placeholder="Enter url" />
                  @error('url')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
        </div>
    </div>
</div>
