@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between">
                <h2>{{ __('Employees')}}</h2>
                @if($user->admin)
                    <a href="{{ route('employee.create') }}">
                        <button class="btn btn-xs btn-success" type="submit" ><i class="fa fa-solid fa-plus"></i></button>
                    </a>
                @endif
            </div>
            @if(Session::get('errors')||count( $errors ) > 0)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="align-middle">{{ __('Name')}}</th>
                        <th class="align-middle">{{ __('Job')}}</th>
                        <th class="align-middle">{{ __('Wage')}}</th>
                        <th class="align-middle">{{ __('Room')}}</th>
                        @if($user->admin)
                            <th class="align-middle">{{ __('Actions')}}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                    <tr>
                        <td class="align-middle">
                            <a href="{{ route('employee.show', $employee->employee_id) }}">{{ $employee->name }} {{ $employee->surname }}</a>
                        </td>
                        <td class="align-middle">{{ $employee->job }}</td>
                        <td class="align-middle">{{ $employee->wage }}</td>
                        <td class="align-middle">
                            @if ($employee->room)
                                <a href="{{ route('room.show', $employee->room->room_id) }}">{{ $employee->room->name }}</a>
                            @endif 
                        </td>

                        @if($user->admin)
                            <td class="d-flex align-middle" style="gap: 10px">
                                <a href="{{ route('employee.edit', $employee->employee_id) }}">
                                    <button class="btn btn-xs btn-primary" type="submit" ><i class="fa fa-solid fa-pencil"></i></button>
                                </a>
                                {{ Form::open(array('route' => array('employee.destroy', $employee->employee_id), 'method' => 'delete')) }}
                                    <button class="btn btn-xs btn-danger" type="submit" ><i class="fa fa-solid fa-trash"></i></button>
                                {{ Form::close() }}
                            </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
