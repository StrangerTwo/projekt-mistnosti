@extends('layouts.app', ['title' => __('Rooms')])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between">
                <h2>{{ __('Rooms')}}</h2>
                @if($user->admin)
                    <a href="{{ route('room.create') }}">
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
                        <th class="align-middle">{{ __('Number')}}</th>
                        <th class="align-middle">{{ __('Name')}}</th>
                        <th class="align-middle">{{ __('Phone')}}</th>
                        @if($user->admin)
                            <th class="align-middle">{{ __('Actions')}}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                    <tr>
                        <td class="align-middle">{{ $room->no }}</td>
                        <td class="align-middle">
                            <a href="{{ route('room.show', $room->room_id) }}">{{ $room->name }}</a>
                        </td>
                        <td class="align-middle">{{ $room->phone }}</td>
                        @if($user->admin)
                            <td class="d-flex align-middle" style="gap: 10px">
                                <a href="{{ route('room.edit', $room->room_id) }}">
                                    <button class="btn btn-xs btn-primary" type="submit" ><i class="fa fa-solid fa-pencil"></i></button>
                                </a>
                                {{ Form::open(array('route' => array('room.destroy', $room->room_id), 'method' => 'delete')) }}
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
