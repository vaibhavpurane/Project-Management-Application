@extends('projects.milestones.show')
@section('tasksContent')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>{{ __('Milestone: ') }}{{ $milestone->name }}</h4>
            </div>
        </div>

        <div class="row mb-4">
            @foreach ($taskStatuses as $taskStatus)
                <div class="col">
                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-between">
                            <span class="card-title fw-bold pt-2">{{ ucfirst($taskStatus->name) }}</span>
                            @if ($taskStatus->name == 'To Do')
                                <a href="#" class="btn btn-link text-right" data-bs-toggle="modal"
                                    data-bs-target="#createTaskModal"><i class="bi bi-plus-circle"></i></a>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <hr/>

        <div class="row" id="tasks-data">
            @if ($taskStatuses)
                @foreach ($taskStatuses as $taskStatus)
                    <div class="col d-flex pe-0">
                        <ul id={{$taskStatus->id}} class="connectedSortable list-unstyled p-2 bg-secondary" style="width: 13rem;" route={{ route('projects.milestones.tasks.reorder', ['project' => $project->id, 'milestone' => $milestone->id]) }}>
                            @foreach ($tasks->where('status_id',$taskStatus->id) as $task)
                                @if ($task->status_id == $taskStatus->id)
                                    @include('projects.milestones.partials._show_tasks',['task', $tasks])
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria-labelledby="createTaskModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form id="createForm"
                    action="{{ route('projects.milestones.tasks.store', ['project' => $project->id, 'milestone' => $milestone->id]) }}"
                    method="POST">
                    @csrf
                    <input type="hidden" name="taskStatus_id" value="{{ $taskStatus->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createTaskModalLabel">{{ __('Add Task') }}</h5>
                    </div>
                    <div class="modal-body">

                        <div class="form-floating mb-3">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus >

                            <label for="name">{{ __('Name') }}</label>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description" required autocomplete="description" autofocus>{{ old('description') }}</textarea>

                            <label for="description">{{ __('Description') }}</label>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
