@extends('layout.master')
@section('title', __('dashboard.edit_item', ['item' => $type->singular()]))
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('partials.page-intro', ['title' => __('dashboard.edit_item', ['item' => $type->singular()]), 'description' => __('dashboard.intros.landing_item_form')])
  <div class="card"><div class="card-body">
    <form method="POST" action="{{ route('admins.landing.items.update', [$type->value, $item->id]) }}">
      @csrf
      @method('PUT')
      @include('admin.landing.items.partials.form', ['type' => $type, 'item' => $item])
      <button type="submit" class="btn btn-primary mt-3">{{ __('app.save') }}</button>
      <a href="{{ route('admins.landing.items.index', $type->value) }}" class="btn btn-label-secondary mt-3">{{ __('app.cancel') }}</a>
    </form>
  </div></div>
</div>
@endsection
