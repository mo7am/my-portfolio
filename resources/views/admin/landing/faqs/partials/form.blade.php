<div class="row">
  <div class="mb-3 col-12">
    <label class="form-label">{{ __('dashboard.question') }}</label>
    <input class="form-control @error('question') is-invalid @enderror" type="text" name="question" value="{{ old('question', $faq->question) }}">
    @error('question')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-12">
    <label class="form-label">{{ __('dashboard.answer') }}</label>
    <textarea class="form-control @error('answer') is-invalid @enderror" name="answer" rows="5">{{ old('answer', $faq->answer) }}</textarea>
    @error('answer')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>
@include('admin.landing.partials.publish-fields', ['sortOrder' => $faq->sort_order, 'isPublished' => $faq->is_published])
