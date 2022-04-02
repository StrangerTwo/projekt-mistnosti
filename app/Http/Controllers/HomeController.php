<?php

namespace App\Http\Controllers;

use App\Room;
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
        $employee = Auth::user();
        
        $rooms = [];
        foreach (Room::all() as $room) {
            $rooms[$room->room_id] = $room->name;
        }
        


        return view('home', [
            'employee' => $employee,
            'rooms' => $rooms
        ]);
    }
}
