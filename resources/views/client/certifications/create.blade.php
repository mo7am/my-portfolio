@extends('layout.master')
@section('title', __('dashboard.create_certification'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.create_certification'), 'description' => __('dashboard.intros.certification_form')])
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('clients.certifications.store') }}">
        @include('client.certifications.partials.form')
      </form>
    </div>
  </div>
</div>
@endsection
