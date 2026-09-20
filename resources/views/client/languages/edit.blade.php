@extends('layout.master')
@section('title', __('dashboard.edit_language'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.edit_language'), 'description' => __('dashboard.intros.language_form')])
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('clients.languages.update', $language->id) }}">
        @csrf
        @method('PUT')
        @include('client.languages.partials.form', ['language' => $language])
        <button type="submit" class="btn btn-primary mt-3">{{ __('app.save') }}</button>
        <a href="{{ route('clients.languages.index') }}" class="btn btn-label-secondary mt-3">{{ __('app.cancel') }}</a>
      </form>
    </div>
  </div>
</div>
@endsection