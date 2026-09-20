@extends('layout.master')
@section('title', __('dashboard.edit_award'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.edit_award'), 'description' => __('dashboard.intros.award_form')])
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('clients.awards.update', $award->id) }}">
        @method('PUT')
        @include('client.awards.partials.form')
      </form>
    </div>
  </div>
</div>
@endsection
