<?php

namespace App\Http\Controllers;

use App\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $employees = User::all();

        foreach ($employees as $employee) {
            $employee->room = $employee->room();
            $employee->keys = $employee->keys();
        }

        return view('employee.index', [
            'user' => $user,
            'employees' => $employees
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

        $rooms = [];
        foreach (Room::all() as $room) {
            $rooms[$room->room_id] = $room->name;
        }

        return view('employee.create', [
            'rooms' => $rooms
        ]);
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
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'job' => ['string', 'max:255'],
            'wage' => ['numeric', 'digits_between:1,11'],
            'room' => ['nullable, exists:room,room_id'],
            'login' => ['nullable', 'string', 'max:60', "unique:employee,login", 'required_with:password'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $employee = new User([
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'job' => $request->get('job'),
            'wage' => $request->get('wage'),
            'room' => $request->get('room'),
            'login' => $request->get('login'),
            'password' => $request->get('login'),
        ]);
        $employee->save();

        return redirect(route('employee.show', $employee->employee_id));
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
        $employee = User::find($id);

        $employee->room = $employee->room();

        return view('employee.show', [
            'user' => $user,
            'employee' => $employee
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

        $employee = User::find($id);

        $rooms = [];
        foreach (Room::all() as $room) {
            $rooms[$room->room_id] = $room->name;
        }
        
        return view('employee.edit', [
            'employee' => $employee,
            'rooms' => $rooms
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
        $employee = User::find($id);

        if (!$employee || !$user->admin && $employee->employee_id != $user->employee_id) return redirect()->back();

        $request->validate([
            'login' => ['nullable', 'string', 'max:60', "unique:employee,login,$employee->employee_id,employee_id", 'required_with:password'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if ($request->get('login') && $request->get('password')) {
            $employee->login = $request->get('login');
            $employee->password = $request->get('password');
        }

        if ($user->admin) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'job' => ['string', 'max:255'],
                'wage' => ['numeric', 'digits_between:1,11'],
                'room' => ['nullable, exists:room,room_id'],
            ]);

            $employee->name = $request->get('name');
            $employee->surname = $request->get('surname');
            $employee->job = $request->get('job');
            $employee->wage = $request->get('wage');
            $employee->room = $request->get('room');
            
            if ($user->employee_id !== $employee->employee_id) {
                $employee->admin = $request->has('admin');
            }
        }

        $employee->save();

        return redirect(route('employee.show', $employee->employee_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
