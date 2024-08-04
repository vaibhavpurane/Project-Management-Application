@extends('projects.show')
@section('milestoneContent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-3">
                <h3> {{__('Project Name: ')}} {{$project->name}}</h3>
            </div>
            <div class="card">
                <div class="card-header d-md-flex justify-content-between">
                    <div>{{ __('Milestones List') }}</div>
                    <div class="justify-content-end">
                        <a class="btn btn-info btn-sm" href="{{ route('projects.milestones.create', ['project' => $project->id]) }}" >
                            <i class="fa fa-plus"></i> {{__('Create New Milestone')}}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-bordered milestone-table" data-project-id="{{ $project->id }}">
                        <thead>
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Due Date')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
