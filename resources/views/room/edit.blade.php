@extends('layouts.app', ['title' => $room->name])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">{{ $room->name }} (č.{{ $room->no }})</h2>
            
            {{ Form::open(array('route' => array('room.update', $room->room_id), 'method' => 'put')) }}
                <div class="form-group row">
                    {{ Form::label('no', __('Number'), array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        <input id="no" type="number" class="form-control @error('no') is-invalid @enderror" name="no" value="{{ old('no', $room->no) }}"  autofocus>

                        @error('no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('name', __('Name'), array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $room->name) }}" >

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('phone', __('Phone'), array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $room->phone) }}" autocomplete="phone" >

                        @error('phone')
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
