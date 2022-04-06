@extends('layouts.app', ['title' => $room->name])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between">
                <h2>{{ $room->name }} (č.{{ $room->no }})</h2>
                @if($user->admin)
                    <a href="{{ route('room.edit', $room->room_id) }}">
                        <button class="btn btn-xs btn-primary" type="submit" ><i class="fa fa-solid fa-pencil"></i></button>
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
            <dl class="row my-5">
                <dt class="col-sm-3">{{ __('Name') }}</dt>
                <dd class="col-sm-9">{{ $room->name }}</dd>
                
                <dt class="col-sm-3">{{ __('Number') }}</dt>
                <dd class="col-sm-9">{{ $room->no }}</dd>
                
                <dt class="col-sm-3">{{ __('Phone') }}</dt>
                <dd class="col-sm-9">{{ $room->phone }}</dd>
            </dl>
            <h3>{{ __('Employees') }}</h3>
            <ul>
                @foreach ($room->employees as $employee)
                    <li><a href="{{ route('employee.show', $employee->employee_id) }}">{{ $employee->name }} {{ $employee->surname }}</a></li>
                @endforeach
            </ul>
            <h3>{{ __('Employees with key') }}</h3>
            <ul>
                @foreach ($room->key_employees as $employee)
                    <li><a href="{{ route('employee.show', $employee->employee_id) }}">{{ $employee->name }} {{ $employee->surname }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
