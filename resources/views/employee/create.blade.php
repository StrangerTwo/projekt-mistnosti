@extends('layouts.app', ['title' => __('New') . " " . __('Employee')])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">{{ __('New')}} {{ __('Employee') }}</h2>
            
            {{ Form::open(array('route' => array('employee.store'), 'method' => 'post')) }}
                <div class="form-group row">
                    {{ Form::label('name', __('Name'), array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>

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
                        <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required>

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
                        <input id="job" type="text" class="form-control @error('job') is-invalid @enderror" name="job" value="{{ old('job') }}">

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
                        <input id="wage" type="number" class="form-control @error('wage') is-invalid @enderror" name="wage" value="{{ old('wage', 0) }}">

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
                        {{ Form::select('room', [null=>''] + $rooms, old('room'), ['class' => "form-control " . ($errors->has('room') ? 'is-invalid' : '')]) }}
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
                        <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" autocomplete="off" >

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
                        <input id="admin" type="checkbox" class="form-control @error('admin') is-invalid @enderror" name="admin" {{ old('admin') ? 'checked' : '' }} >

                        @error('admin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary d-block float-right">{{ __('Save') }}</button>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
