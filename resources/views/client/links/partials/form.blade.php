<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="mb-3 col-sm-6">
                <label for="color" class="form-label">Color</label>
                <input style="height: 45px !important;" class="form-control @error('color') is-invalid @enderror" type="color" id="color" name="color" value="{{old('color', $link->color)}}" placeholder="Enter color" />
                  @error('color')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
              <div class="mb-3 col-sm-6">
                <label for="link" class="form-label">Icon</label>
                <div class="input-group mb-3">
                    <span class="input-group-text selected-icon"></span>
                    <input type="text" class="form-control iconpicker @error('icon') is-invalid @enderror" name="icon" value="{{ old('icon', $link->icon ?? '') }}" placeholder="Choose icon">
                </div>
                @error('icon')
                    <div class="invalid-feedback text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-sm-12">
                <label for="link" class="form-label">Link</label>
                <input class="form-control @error('link') is-invalid @enderror" type="text" id="link" name="link" value="{{old('link', $link->link)}}" placeholder="Enter link" />
                  @error('link')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('https://unpkg.com/codethereal-iconpicker@1.2.1/dist/iconsets/bootstrap5.json')
            .then(response => response.json())
            .then(iconList => {
                const picker = new Iconpicker(document.querySelector(".iconpicker"), {
                    icons: iconList,
                    showSelectedIn: document.querySelector(".selected-icon"),
                    searchable: true,
                    hideOnSelect: true,
                    defaultValue: "{{ old('icon', $link->icon ?? 'bi-facebook') }}",
                    valueFormat: val => val ? (val.startsWith('bi ') ? val : `bi ${val}`) : '',
                    containerClass: "my-icon-picker" 
                });

                picker.on("change", function(e) {
                    console.log("Icon chosen:", e.detail.value);
                });
            })
            .catch(err => {
                console.error("Failed to load icons JSON:", err);
            });
        });
    </script>
@endsection