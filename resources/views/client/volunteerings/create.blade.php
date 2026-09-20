@extends('layout.master')
@section('title', __('dashboard.create_volunteering'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.create_volunteering'), 'description' => __('dashboard.intros.volunteering_form')])
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('clients.volunteerings.store') }}">
        @include('client.volunteerings.partials.form')
      </form>
    </div>
  </div>
</div>
@endsection
