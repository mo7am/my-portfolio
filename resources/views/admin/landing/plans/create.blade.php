@extends('layout.master')
@section('title', __('dashboard.create_landing_plan'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.create_landing_plan'), 'description' => __('dashboard.intros.landing_plan_form')])
  <div class="card"><div class="card-body">
    <form method="POST" action="{{ route('admins.landing.plans.store') }}">
      @csrf
      @include('admin.landing.plans.partials.form', ['plan' => $plan])
      <button type="submit" class="btn btn-primary mt-3">{{ __('app.save') }}</button>
      <a href="{{ route('admins.landing.plans.index') }}" class="btn btn-label-secondary mt-3">{{ __('app.cancel') }}</a>
    </form>
  </div></div>
</div>
@endsection
