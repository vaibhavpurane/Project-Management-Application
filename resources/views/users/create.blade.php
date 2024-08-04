@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header d-md-flex justify-content-between">
					<div>{{ __('Create User') }}</div>
					<div class="justify-content-end">
						<a class="btn btn-info btn-sm" href="{{ route('users.index') }}" >
							<i class="fa fa-plus"></i> {{__('Back')}}
						</a>
					</div>
				</div>
				<div class="card-body">
                    <form method="POST" action="{{ route('users.store')}}" enctype="multipart/form-data" class="userValidation">
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
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus >

                            <label for="email">{{ __('Email') }}</label>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus >

                            <label for="phone">{{ __('Phone') }}</label>

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password" autofocus >

                            <label for="password">{{ __('Password') }}</label>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password Confirm" required autocomplete="new-password" autofocus >

                            <label for="password-confirm">{{ __('Password Confirm') }}</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select @error('role') is-invalid @enderror" name="role" required aria-label="Default ">
                                <option value="" disabled selected>{{__('--- Please, Select a Role ---')}}</option>
                                <option value="1" @if (old('role')==1)selected @endif>{{__('Admin')}}</option>
                                <option value="2" @if (old('role')==2)selected @endif>{{__('Manager')}}</option>
                                <option value="3" @if (old('role')==3)selected @endif>{{__('Developer')}}</option>
                            </select>

                            <label for="role">{{ __('Role') }}</label>

                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <div class="form-check-inline @error('is_active') is-invalid @enderror ms-2">
                                <label for="is_active" >{{__('Is Active :')}}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input " type="radio" name="is_active" id="is_active1" value="0" @if(old('is_active')) checked @endif>
                                <label class="form-check-label" for="is_active">{{__('In-Active')}}<label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input " type="radio" name="is_active" id="is_active2" value="1" @if(old('is_active')) checked @endif>
                                <label class="form-check-label" for="is_active">{{__('Active')}}<label>
                            </div>
                            @error('is_active')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-floating mb-3">
                            <input id="colour_pallate" type="text" class="form-control @error('colour_pallate') is-invalid @enderror" name="colour_pallate" placeholder="Colour Pallate" value="{{ old('colour_pallate') }}" required autocomplete="colour_pallate" autofocus >

                            <label for="colour_pallate">{{ __('Colour Pallate') }}</label>

                            @error('colour_pallate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" placeholder="Image" value="{{ old('image') }}" autocomplete="image" required autofocus>

                            <label for="image">{{ __('File') }}</label>

                            @error('image')
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
