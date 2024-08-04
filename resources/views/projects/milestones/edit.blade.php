@extends('projects.show')
@section('milestoneContent')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header d-md-flex justify-content-between">
					<div>{{ __('Edit Milestone') }}</div>
					<div class="justify-content-end">
						<a class="btn btn-info btn-sm" href="{{ route('projects.milestones.index', ['project' => $projects->id])}}">
							<i class="fa fa-plus"></i> {{__('Back')}}
						</a>
					</div>
				</div>
				<div class="card-body">
                    {{-- <h5> {{$milestone->id}} </h5> --}}
                    <form method="POST" action="{{ route('projects.milestones.update', ['project' => $projects->id, 'milestone' => $milestone->id])}}" class="milestoneValidation">
                        @csrf
                        @method('PUT')
                        <div class="form-floating mb-3">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name',$milestone->name) }}" required autocomplete="name" autofocus >

                            <label for="name">{{ __('Name') }}</label>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" placeholder="Due Date" value="{{ old('due_date',$milestone->due_date) }}" autocomplete="due_date" autofocus >

                            <label for="due_date">{{ __('Due Date') }}</label>

                            @error('due_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-control @error('statuses_id') is-invalid @enderror" name="statuses_id" id="statuses_id" aria-label="Default" required>
                                <option value="" disabled selected>{{__('--- Please, Select Statuses ---')}}</option>
                                @foreach ($statuses as $status)
                                    <option value="{{$status->id}}">{{__($status->name)}}</option>
                                @endforeach
                            </select>
                            @error('statuses_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-info"> {{ __('Save') }}</button>
                    </form>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection
