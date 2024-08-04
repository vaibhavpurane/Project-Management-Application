@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-md-flex justify-content-between">
                    <div>{{ __('Users List') }}</div>
                    <div class="justify-content-end">
                        <a class="btn btn-info btn-sm" href="{{ route('users.create') }}" >
                            <i class="fa fa-plus"></i> Create New User
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Phone')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        <a href="{{ route('users.show', $user) }}">Show</a>
                                        <a href="{{ route('users.edit', $user) }}">Edit</a>
                                        <a href="{{ route('users.destroy', $user) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

