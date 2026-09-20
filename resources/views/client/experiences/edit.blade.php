@extends('layout.master')
@section('title', __('dashboard.edit_experience'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.edit_experience'), 'description' => __('dashboard.intros.experience_form')])
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('clients.experiences.update', $experience->id) }}">
        @csrf
        @method('PUT')
        @include('client.experiences.partials.form', ['experience' => $experience])
        <button type="submit" class="btn btn-primary mt-3">{{ __('app.save') }}</button>
        <a href="{{ route('clients.experiences.index') }}" class="btn btn-label-secondary mt-3">{{ __('app.cancel') }}</a>
      </form>
    </div>
  </div>
</div>
@endsection