@extends('layout.master')
@section('title', __('dashboard.create_experience'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.create_experience'), 'description' => __('dashboard.intros.experience_form')])
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('clients.experiences.store') }}">
        @csrf
        @include('client.experiences.partials.form', ['experience' => $experience])
        <button type="submit" class="btn btn-primary mt-3">{{ __('app.save') }}</button>
        <a href="{{ route('clients.experiences.index') }}" class="btn btn-label-secondary mt-3">{{ __('app.cancel') }}</a>
      </form>
    </div>
  </div>
</div>
@endsection