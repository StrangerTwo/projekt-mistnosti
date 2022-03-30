<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'room';
    
    protected $fillable = ['no', 'name', 'phone'];

    protected $primaryKey = 'room_id'; 
}
