@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between">
                <h2>{{ $employee->name }} {{ $employee->surname }}</h2>
                @if($user->admin)
                    <a href="{{ route('employee.edit', $employee->employee_id) }}">
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
                <dd class="col-sm-9">{{ $employee->name }}</dd>
                
                <dt class="col-sm-3">{{ __('Surname') }}</dt>
                <dd class="col-sm-9">{{ $employee->surname }}</dd>
                
                <dt class="col-sm-3">{{ __('Job') }}</dt>
                <dd class="col-sm-9">{{ $employee->job }}</dd>
                
                <dt class="col-sm-3">{{ __('Wage') }}</dt>
                <dd class="col-sm-9">{{ $employee->wage }}</dd>

                <dt class="col-sm-3">{{ __('Room') }}</dt>
                <dd class="col-sm-9">
                    @if($employee->room)
                        <a href="{{ route('room.show', $employee->room->room_id) }}">{{ $employee->room->name }}</a>
                    @endif
                </dd>
            </dl>
            <dl class="row my-5">
                <dt class="col-sm-3">{{ __('Login') }}</dt>
                <dd class="col-sm-9">{{ $employee->login }}</dd>
            </dl>
            <h3>{{ __('Keys') }}</h3>
            <ul>
                @foreach ($employee->keys as $key)
                    <li><a href="{{ route('room.show', $key->room_id) }}">{{ $key->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
