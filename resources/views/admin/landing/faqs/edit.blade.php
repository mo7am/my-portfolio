@extends('layout.master')
@section('title', __('dashboard.edit_landing_faq'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.edit_landing_faq'), 'description' => __('dashboard.intros.landing_faq_form')])
  <div class="card"><div class="card-body">
    <form method="POST" action="{{ route('admins.landing.faqs.update', $faq->id) }}">
      @csrf
      @method('PUT')
      @include('admin.landing.faqs.partials.form', ['faq' => $faq])
      <button type="submit" class="btn btn-primary mt-3">{{ __('app.save') }}</button>
      <a href="{{ route('admins.landing.faqs.index') }}" class="btn btn-label-secondary mt-3">{{ __('app.cancel') }}</a>
    </form>
  </div></div>
</div>
@endsection
