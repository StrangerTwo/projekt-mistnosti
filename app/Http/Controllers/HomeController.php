<?php

namespace App\Http\Controllers;

use App\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employee = User::find(Auth::id());
        
        $rooms = [];
        foreach (Room::all() as $room) {
            $rooms[$room->room_id] = $room->name;
        }
        
        $employee->keys = $employee->keys()->all();

        return view('home', [
            'employee' => $employee,
            'rooms' => $rooms
        ]);
    }
}
