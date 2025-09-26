@extends('layout.master')

@section('title', 'Create Project')

@section('styles')

@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('clients.projects.index') }}"> Projects </a>/</span> New Project</h4>
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">New Project</h5>
                <small class="text-muted float-end"></small>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('clients.projects.store')}}">
                    @csrf
                    @include('client.projects.partials.form', ['project' => $project, 'projectGroups' => $projectGroups])
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary mt-3">Add</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
