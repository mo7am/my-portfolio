<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="mb-3 col-sm-12">
                <label for="educational" class="form-label">Educational</label>
                <input class="form-control @error('educational') is-invalid @enderror" type="text" id="educational" name="educational" value="{{old('educational', $educational->educational)}}" placeholder="Enter educational" />
                  @error('educational')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
            <div class="mb-3 col-sm-6">
                <label for="start_date" class="form-label">Start Date</label>
                <input class="form-control @error('start_date') is-invalid @enderror" type="date" id="start_date" name="start_date" value="{{ old('start_date', optional($educational->start_date)->format('Y-m-d')) }}" placeholder="YYYY-MM-DD" />
                  @error('start_date')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
              </div>
              <div class="mb-3 col-sm-6">
                <label for="end_date" class="form-label">End Date</label>
                <input class="form-control @error('end_date') is-invalid @enderror" type="date" id="end_date" name="end_date" value="{{ old('end_date', optional($educational->end_date)->format('Y-m-d')) }}" placeholder="YYYY-MM-DD" />
                  @error('end_date')
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
        $('#start_date').flatpickr({
            monthSelectorType: 'static',
        });

        $('#end_date').flatpickr({
            monthSelectorType: 'static',
        });
    });
    </script>
@endsection
