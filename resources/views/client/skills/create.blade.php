@extends('layout.master')
@section('title', __('dashboard.create_skill'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.create_skill'), 'description' => __('dashboard.intros.skill_form')])
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('clients.skills.store') }}">
        @csrf
        @include('client.skills.partials.form', ['skill' => $skill])
        <button type="submit" class="btn btn-primary mt-3">{{ __('app.save') }}</button>
        <a href="{{ route('clients.skills.index') }}" class="btn btn-label-secondary mt-3">{{ __('app.cancel') }}</a>
      </form>
    </div>
  </div>
</div>
@endsection