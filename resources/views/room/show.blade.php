@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>{{ $room->name }} (č.{{ $room->no }})</h2>
            
        </div>
    </div>
</div>
@endsection
