@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
                @if ($user)
				<div class="card-header d-md-flex justify-content-between">
					<div>{{ __('User Details') }}</div>
					<div class="justify-content-end">
						<a class="btn btn-info btn-sm" href="{{ route('users.index') }}" >
							<i class="fa fa-plus"></i> {{__('Back')}}
						</a>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>{{__('User Name')}}</td>
                                <td> {{ucfirst($user->name)}} </td>
                            </tr>
                            <tr>
                                <td>{{__('Email Id')}}</td>
                                <td> {{$user->email}} </td>
                            </tr>
                            <tr>
                                <td>{{__('Phone')}}</td>
                                <td> {{$user->phone}} </td>
                            </tr>
                            <tr>
                                <td>{{__('Role')}}</td>
                                <td> {{ucfirst($user->role)}} </td>
                            </tr>
                            <tr>
                                <td>{{__('Is Active')}}</td>
                                <td>
                                    @if ($user->is_active == 1)
                                        {{__('Active')}}
                                    @else
                                        {{__('In Active')}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>{{__('Colour Pallate')}} </td>
                                <td> {{$user->colour_pallate}} </td>
                            </tr>
                            <tr>
                                @if ($user->image)
                                    <td>{{__('Image')}} </td>
                                    <td> <img src="{{asset('storage/'.$user->image)}}" height="120px" width="100px" alt="{{$user->name}}"> </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
				</div>
                @else
                <div class="ms-2">
                    {{__('User is not present with this Id')}}
                </div>
                @endif
			</div>
		</div>
	</div>
</div>

@endsection
