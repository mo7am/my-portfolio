@extends('layout.master')

@section('title', 'Edit Project Group')

@section('styles')

@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('clients.project-groups.index') }}"> Project Groups </a>/</span> Edit</h4>
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $projectGroup->project_work }}</h5>
                <small class="text-muted float-end"></small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('clients.project-groups.update', $projectGroup->id) }}">
                    @csrf
                    @method('PUT')
                    @include('client.project-groups.partials.form', ['projectGroup' => $projectGroup])
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
