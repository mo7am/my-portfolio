@extends('layout.master')
@section('title', __('dashboard.edit_landing_testimonial'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.edit_landing_testimonial'), 'description' => __('dashboard.intros.landing_testimonial_form')])
  <div class="card"><div class="card-body">
    <form method="POST" action="{{ route('admins.landing.testimonials.update', $testimonial->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      @include('admin.landing.testimonials.partials.form', ['testimonial' => $testimonial])
      <button type="submit" class="btn btn-primary mt-3">{{ __('app.save') }}</button>
      <a href="{{ route('admins.landing.testimonials.index') }}" class="btn btn-label-secondary mt-3">{{ __('app.cancel') }}</a>
    </form>
  </div></div>
</div>
@endsection
