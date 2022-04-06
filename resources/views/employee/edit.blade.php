@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">{{ $employee->name }} {{ $employee->surname }}</h2>
            
            {{ Form::open(array('route' => array('employee.update', $employee->employee_id), 'method' => 'put')) }}
                <div class="form-group row">
                    {{ Form::label('name', __('Name'), array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $employee->name) }}" required autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('surname', __('Surname'), array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname', $employee->surname) }}" required>

                        @error('surname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('job', __('Job'), array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        <input id="job" type="text" class="form-control @error('job') is-invalid @enderror" name="job" value="{{ old('job', $employee->job) }}">

                        @error('job')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('wage', __('Wage'), array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        <input id="wage" type="number" class="form-control @error('wage') is-invalid @enderror" name="wage" value="{{ old('wage', $employee->wage) }}">

                        @error('wage')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('room', __('Room'), array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{-- {{ Form::select('room',  $rooms, null, ['class' => 'form-control']) }} --}}
                        {{ Form::select('room', [null=>''] + $rooms, old('room', $employee->room), ['class' => "form-control " . ($errors->has('room') ? 'is-invalid' : '')]) }}
                        @error('room')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <legend class="my-3">{{ __('Authentication') }}:</legend>
                <div class="form-group row">
                    {{ Form::label('login', __('Login'), array('class' => 'col-sm-3 col-form-label')) }}
                    <div class="col-sm-9">
                        <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login', $employee->login) }}" autocomplete="off" >

                        @error('login')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('password', __('Password'), array('class' => 'col-sm-3 col-form-label')) }}
                    <div class="col-sm-9">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" autocomplete="off" >

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('password_confirmation', __('Repeat Password'), array('class' => 'col-sm-3 col-form-label')) }}
                    <div class="col-sm-9">
                        <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="" autocomplete="off" >

                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('admin', __('Admin'), array('class' => 'col-sm-3 col-form-label')) }}
                    <div class="col-sm-9">
                        <input id="admin" type="checkbox" class="form-control @error('admin') is-invalid @enderror" name="admin" {{ old('admin', $employee->admin) ? 'checked' : '' }} >

                        @error('admin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <legend class="my-3">{{ __('Keys') }}:</legend>
                <div class="form-group row">
                    @foreach ($rooms as $room_id => $room)
                        <input type="checkbox" value="{{ $room_id }}" class="form-control col-sm-1 @error('keys') is-invalid @enderror" id="keys[{{$room_id}}]" name="keys[{{$room_id}}]" @if (in_array($room_id, array_column($employee->keys, 'room_id'))) checked @endif/>
                        {{ Form::label("keys[$room_id]", $room, array('class' => 'col-sm-3 col-form-label')) }}
                    @endforeach

                    @error('keys')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary d-block float-right">{{ __('Save') }}</button>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
