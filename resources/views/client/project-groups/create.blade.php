@extends('layout.master')
@section('title', __('dashboard.create_project_group'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.create_project_group'), 'description' => __('dashboard.intros.project_group_form')])
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('clients.project-groups.store') }}">
        @csrf
        @include('client.project-groups.partials.form', ['projectGroup' => $projectGroup])
        <button type="submit" class="btn btn-primary mt-3">{{ __('app.save') }}</button>
        <a href="{{ route('clients.project-groups.index') }}" class="btn btn-label-secondary mt-3">{{ __('app.cancel') }}</a>
      </form>
    </div>
  </div>
</div>
@endsection