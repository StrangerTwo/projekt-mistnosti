<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();

        foreach ($rooms as $room) {
            $room->users = $room->users();
        }

        return view('room.index', [
            'rooms' => $rooms,
            'user' => Auth::user()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if (!$user->admin) return redirect()->back();

        return view('room.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user->admin) return redirect()->back();

        $request->validate([
            'no' => ['required', 'numeric', 'unique:room'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['string', 'max:15'],
        ]);
        
        $room = new Room([
            'no' => $request->get('no'),
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
        ]);

        $room->save();

        return redirect(route('room.show', $room->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);

        return view('room.show', [
            'room' => $room,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        if (!$user->admin) return redirect()->back();

        $room = Room::find($id);

        return view('room.edit', [
            'room' => $room,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user->admin) return redirect()->back();

        $room = Room::find($id);

        if (!$room) return redirect(route('room.index'));

        $request->validate([
            'no' => ['required', 'numeric', "unique:room,no,$room->room_id,room_id"],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['string', 'max:15'],
        ]);

        $room->update([
            'no' => $request->get('no'),
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();

        if (!$user->admin) return redirect()->back();
        
        $room = Room::find($id);
        if($room) $room->delete();

        return redirect(route('room.index'));
    }
}
