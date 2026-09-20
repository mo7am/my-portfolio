@extends('layout.master')
@section('title', __('dashboard.edit_project'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.edit_project'), 'description' => __('dashboard.intros.project_form')])
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('clients.projects.update', $project->id) }}">
        @csrf
        @method('PUT')
        @include('client.projects.partials.form', ['project' => $project])
        <button type="submit" class="btn btn-primary mt-3">{{ __('app.save') }}</button>
        <a href="{{ route('clients.projects.index') }}" class="btn btn-label-secondary mt-3">{{ __('app.cancel') }}</a>
      </form>
    </div>
  </div>
</div>
@endsection