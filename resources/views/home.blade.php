@extends('layouts.app', ['title' => __('Home')])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Session::get('errors')||count( $errors ) > 0)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
            {{ Form::open(array('route' => array('employee.update', $employee->employee_id), 'method' => 'put', 'class' => 'my-5')) }}
                <div class="form-group row">
                    {{ Form::label('name', __('Name'), array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $employee->name) }}" required autofocus @if(!$employee->admin) readonly @endif>

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
                        <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname', $employee->surname) }}" required @if(!$employee->admin) readonly @endif>

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
                        <input id="job" type="text" class="form-control @error('job') is-invalid @enderror" name="job" value="{{ old('job', $employee->job) }}" @if(!$employee->admin) readonly @endif>

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
                        <input id="wage" type="number" class="form-control @error('wage') is-invalid @enderror" name="wage" value="{{ old('wage', $employee->wage) }}" @if(!$employee->admin) readonly @endif>

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
                        <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login', $employee->login) }}" autocomplete="off" @if($employee->login) readonly @endif>

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
                @if ($employee->admin)
                    <div class="form-group row">
                        {{ Form::label('admin', __('Admin'), array('class' => 'col-sm-3 col-form-label')) }}
                        <div class="col-sm-9">
                            <input id="admin" type="checkbox" class="form-control @error('admin') is-invalid @enderror" name="admin" {{ old('admin', $employee->admin) == 1 ? 'checked' : '' }}>

                            @error('admin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                @endif
                <legend>{{ __('Keys') }}</legend>
                <ul>
                    @foreach ($employee->keys as $key)
                        <li><a href="{{ route('room.show', $key->room_id) }}">{{ $key->name }}</a></li>
                    @endforeach
                </ul>
                <button type="submit" class="btn btn-primary d-block float-right">{{ __('Save') }}</button>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
