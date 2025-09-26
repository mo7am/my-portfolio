<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="first_name" class="form-label">First Name</label>
                <input class="form-control @error('first_name') is-invalid @enderror" type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" placeholder="Enter first name" />
                  @error('first_name')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="second_name" class="form-label">Second Name</label>
                <input class="form-control @error('second_name') is-invalid @enderror" type="text" id="second_name" name="second_name" value="{{ old('second_name', $user->second_name) }}" placeholder="Enter second name" />
                  @error('second_name')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="email" class="form-label">Email</label>
                <input class="form-control @error('email') is-invalid @enderror" type="text" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter email" />
                  @error('email')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input class="form-control @error('phone') is-invalid @enderror" type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Enter phone" />
                  @error('phone')
                      <div class="invalid-feedback text-sm">{{ $message }}</div>
                  @enderror
            </div>
        </div>
    </div>
</div>
