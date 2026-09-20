@extends('layout.master')
@section('title', __('dashboard.edit_reference'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.edit_reference'), 'description' => __('dashboard.intros.reference_form')])
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('clients.references.update', $reference->id) }}">
        @method('PUT')
        @include('client.references.partials.form')
      </form>
    </div>
  </div>
</div>
@endsection
