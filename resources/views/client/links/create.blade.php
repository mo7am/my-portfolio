@extends('layout.master')
@section('title', __('dashboard.create_link'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.create_link'), 'description' => __('dashboard.intros.link_form')])
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('clients.links.store') }}">
        @csrf
        @include('client.links.partials.form', ['link' => $link])
        <button type="submit" class="btn btn-primary mt-3">{{ __('app.save') }}</button>
        <a href="{{ route('clients.links.index') }}" class="btn btn-label-secondary mt-3">{{ __('app.cancel') }}</a>
      </form>
    </div>
  </div>
</div>
@endsection