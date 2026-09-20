@extends('layout.master')
@section('title', __('dashboard.edit_course'))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.edit_course'), 'description' => __('dashboard.intros.course_form')])
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('clients.courses.update', $course->id) }}">
        @method('PUT')
        @include('client.courses.partials.form')
      </form>
    </div>
  </div>
</div>
@endsection
