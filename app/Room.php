<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $table = 'room';
    
    protected $fillable = ['no', 'name', 'phone'];

    protected $primaryKey = 'room_id';

    public function employees()
    {
        return User::where('room', $this->room_id)->get();
        // return $this->hasMany(User::class, 'room', 'room_id');
    }

    public function key_employees()
    {
        return DB::table('key')
            ->join('employee', 'employee', '=', 'employee_id')
            ->where('key.room', '=', $this->room_id)
            ->select('employee.*')
            ->get();
    }
}
