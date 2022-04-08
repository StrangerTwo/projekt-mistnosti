<?php

namespace App\Http\Controllers;

use App\Key;
use App\Room;
use App\User;
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

        $validator = Validator::make($request->all(), [
            'no' => ['required', 'numeric', 'unique:room'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['string', 'max:15'],
        ]);
        if ($validator->fails()) {
            return redirect(route('room.index'))->withErrors($validator);
        }
        
        $room = new Room([
            'no' => $request->get('no'),
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
        ]);

        $room->save();

        return redirect(route('room.show', $room->room_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        $room = Room::find($id);
        $room->employees = $room->employees();
        $room->key_employees = $room->key_employees()->all();

        return view('room.show', [
            'user' => $user,
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

        $validator = Validator::make($request->all(), [
            'no' => ['required', 'numeric', "unique:room,no,$room->room_id,room_id"],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['string', 'max:15'],
        ]);
        if ($validator->fails()) {
            return redirect(route('room.edit', $id))->withErrors($validator);
        }

        $room->update([
            'no' => $request->get('no'),
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
        ]);

        return redirect(route('room.show', $id));
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

        if (!$user->admin) return redirect(route('room.index'));

        $room = Room::find($id);
        if(!$room) return redirect(route('room.index'));

        if (User::where('room', '=', $id)->count() > 0) {
            return redirect(route('room.index'))->withErrors(['error' => 'Nelze smazat, dokud je k místnosti přizazen nějaký zaměstnanec']);
        }
        
        Key::where('room', $id)->delete();
        $room->delete();

        return redirect(route('room.index'));
    }
}
