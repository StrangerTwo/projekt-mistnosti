<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $table = 'room';
    
    protected $fillable = ['no', 'name', 'phone'];

    protected $primaryKey = 'room_id';

    public function users()
    {
        return User::where('room', $this->room_id)->get();
        // return $this->hasMany(User::class, 'room', 'room_id');
    }
}
