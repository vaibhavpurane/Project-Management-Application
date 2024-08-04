@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-md-flex justify-content-between">
                    <div>{{ __('Projects List') }}</div>
                    <div class="justify-content-end">
                        <a class="btn btn-info btn-sm" href="{{ route('projects.create') }}" >
                            <i class="fa fa-plus"></i> {{__('Create New Project')}}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-bordered project-table">
                        <thead>
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Start Date')}}</th>
                                <th>{{__('Active')}}</th>
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
