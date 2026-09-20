@extends('layout.master')
@section('title', __('dashboard.create_educational'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.create_educational'), 'description' => __('dashboard.intros.educational_form')])
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('clients.educationals.store') }}">
        @csrf
        @include('client.educationals.partials.form', ['educational' => $educational])
        <button type="submit" class="btn btn-primary mt-3">{{ __('app.save') }}</button>
        <a href="{{ route('clients.educationals.index') }}" class="btn btn-label-secondary mt-3">{{ __('app.cancel') }}</a>
      </form>
    </div>
  </div>
</div>
@endsection