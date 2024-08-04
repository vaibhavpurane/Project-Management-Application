@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header d-md-flex justify-content-between">
					<div>{{ __('Create New Project') }}</div>
					<div class="justify-content-end">
						<a class="btn btn-info btn-sm" href="{{ route('projects.index') }}" >
							<i class="fa fa-plus"></i> {{__('Back')}}
						</a>
					</div>
				</div>
				<div class="card-body">
                    <form method="POST" action="{{ route('projects.store')}}" class="projectValidation">
                        @csrf

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
                            <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" placeholder="Start Date" value="{{ old('start_date') }}" required autocomplete="start_date" autofocus >

                            <label for="start_date">{{ __('Start Date') }}</label>

                            @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- <div class="form-floating mb-3">
                            <div class="form-check-inline @error('active') is-invalid @enderror ms-2">
                                <label for="active" >{{__('Active :')}}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input " type="radio" name="active" id="active_1" value="0" @if(old('active')) checked @endif>
                                <label class="form-check-label" for="active">{{__('In-Active')}}<label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input " type="radio" name="active" id="active_2" value="1" @if(old('active')) checked @endif>
                                <label class="form-check-label" for="active">{{__('Active')}}<label>
                            </div>
                            @error('active')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}

                        <div class="form-floating mb-3">
                            <select class="form-control selectUser @error('user_id') is-invalid @enderror" name="user_id[]" multiple id="user_id" required aria-label="Default " placeholder="Select Users">
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{__($user->name)}}</option>
                                @endforeach
                            </select>
                            @error('user_id')
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
