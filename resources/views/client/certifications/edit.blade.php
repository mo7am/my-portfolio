@extends('layout.master')
@section('title', __('dashboard.edit_certification'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.edit_certification'), 'description' => __('dashboard.intros.certification_form')])
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('clients.certifications.update', $certification->id) }}">
        @method('PUT')
        @include('client.certifications.partials.form')
      </form>
    </div>
  </div>
</div>
@endsection
