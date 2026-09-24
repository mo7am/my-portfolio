@php
  $icons = ['globe','layers','file','languages','cloud','sliders','star','users','zap','shield','heart','briefcase'];
@endphp
<div class="row">
  <div class="mb-3 col-12">
    <label class="form-label">{{ __('dashboard.title') }}</label>
    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title', $item->title) }}">
    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-12">
    <label class="form-label">{{ __('dashboard.body') }}</label>
    <textarea class="form-control @error('body') is-invalid @enderror" name="body" rows="4">{{ old('body', $item->body) }}</textarea>
    @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  @if($type === \App\Enums\LandingItemType::Feature)
    <div class="mb-3 col-md-6">
      <label class="form-label">{{ __('dashboard.icon') }}</label>
      <select class="form-select @error('icon') is-invalid @enderror" name="icon">
        @foreach($icons as $icon)
          <option value="{{ $icon }}" @selected(old('icon', $item->icon) === $icon)>{{ $icon }}</option>
        @endforeach
      </select>
      @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
  @endif
  @if($type === \App\Enums\LandingItemType::Step)
    <div class="mb-3 col-md-4">
      <label class="form-label">{{ __('dashboard.step_number') }}</label>
      <input class="form-control @error('meta') is-invalid @enderror" type="text" name="meta" value="{{ old('meta', $item->meta) }}" placeholder="01">
      @error('meta')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
  @endif
</div>
@include('admin.landing.partials.publish-fields', ['sortOrder' => $item->sort_order, 'isPublished' => $item->is_published])
