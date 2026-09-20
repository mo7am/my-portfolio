@extends('layout.master')
@section('title', __('dashboard.create_website'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.create_website'), 'description' => __('dashboard.intros.website_form')])
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('clients.websites.store') }}">
        @csrf
        @include('client.websites.partials.form', ['website' => $website])
        <button type="submit" class="btn btn-primary mt-3">{{ __('app.save') }}</button>
        <a href="{{ route('clients.websites.index') }}" class="btn btn-label-secondary mt-3">{{ __('app.cancel') }}</a>
      </form>
    </div>
  </div>
</div>
@endsection