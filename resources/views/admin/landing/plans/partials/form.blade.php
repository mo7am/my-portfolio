@php
  $featuresText = old('features_text', $plan->exists ? $plan->featuresTextForLocale() : '');
  $ctaParamsJson = old('cta_params_json', $plan->cta_params ? json_encode($plan->cta_params, JSON_UNESCAPED_UNICODE) : '');
@endphp
<div class="row">
  <div class="mb-3 col-md-4">
    <label class="form-label">{{ __('dashboard.code') }}</label>
    <input class="form-control @error('code') is-invalid @enderror" type="text" name="code" value="{{ old('code', $plan->code) }}" placeholder="free">
    @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
    <div class="form-text">{{ __('dashboard.billing_ready_hint') }}</div>
  </div>
  <div class="mb-3 col-md-4">
    <label class="form-label">{{ __('dashboard.name') }}</label>
    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name', $plan->name) }}">
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-4">
    <label class="form-label">{{ __('dashboard.badge') }}</label>
    <input class="form-control @error('badge') is-invalid @enderror" type="text" name="badge" value="{{ old('badge', $plan->badge) }}">
    @error('badge')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-12">
    <label class="form-label">{{ __('dashboard.description') }}</label>
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="2">{{ old('description', $plan->description) }}</textarea>
    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-3">
    <label class="form-label">{{ __('dashboard.price') }}</label>
    <input class="form-control @error('price_monthly') is-invalid @enderror" type="number" step="0.01" min="0" name="price_monthly" value="{{ old('price_monthly', $plan->price_monthly) }}">
    @error('price_monthly')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-3">
    <label class="form-label">{{ __('dashboard.currency') }}</label>
    <input class="form-control @error('currency') is-invalid @enderror" type="text" name="currency" value="{{ old('currency', $plan->currency ?: 'USD') }}" maxlength="3">
    @error('currency')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-3">
    <label class="form-label">{{ __('dashboard.period_label') }}</label>
    <input class="form-control @error('period_label') is-invalid @enderror" type="text" name="period_label" value="{{ old('period_label', $plan->period_label) }}" placeholder="/ month">
    @error('period_label')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-3">
    <label class="form-label">{{ __('dashboard.cta_label') }}</label>
    <input class="form-control @error('cta_label') is-invalid @enderror" type="text" name="cta_label" value="{{ old('cta_label', $plan->cta_label) }}">
    @error('cta_label')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-12">
    <label class="form-label">{{ __('dashboard.plan_features') }}</label>
    <textarea class="form-control @error('features_text') is-invalid @enderror" name="features_text" rows="6" placeholder="{{ __('dashboard.plan_features_hint') }}">{{ $featuresText }}</textarea>
    @error('features_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-4">
    <label class="form-label">{{ __('dashboard.cta_route') }}</label>
    <input class="form-control @error('cta_route') is-invalid @enderror" type="text" name="cta_route" value="{{ old('cta_route', $plan->cta_route ?: 'register') }}">
    @error('cta_route')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-4">
    <label class="form-label">{{ __('dashboard.cta_params') }}</label>
    <input class="form-control @error('cta_params_json') is-invalid @enderror" type="text" name="cta_params_json" value="{{ $ctaParamsJson }}" placeholder='{"plan":"pro"}'>
    @error('cta_params_json')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-md-4">
    <label class="form-label">{{ __('dashboard.billing_plan_id') }}</label>
    <input class="form-control @error('billing_plan_id') is-invalid @enderror" type="text" name="billing_plan_id" value="{{ old('billing_plan_id', $plan->billing_plan_id) }}">
    @error('billing_plan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3 col-12">
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" name="is_highlighted" value="1" id="is_highlighted" @checked(old('is_highlighted', $plan->is_highlighted))>
      <label class="form-check-label" for="is_highlighted">{{ __('dashboard.highlighted_plan') }}</label>
    </div>
  </div>
</div>
@include('admin.landing.partials.publish-fields', ['sortOrder' => $plan->sort_order, 'isPublished' => $plan->is_published])
