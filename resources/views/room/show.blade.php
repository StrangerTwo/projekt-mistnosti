@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>{{ $room->name }} (č.{{ $room->no }})</h2>
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
        </div>
    </div>
</div>
@endsection
