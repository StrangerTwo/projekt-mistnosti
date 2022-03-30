<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'employee';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'job', 'wage',
    ];

    protected $primaryKey = 'employee_id';

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function keysRooms()
    {
        return $this->hasManyThrough(
            Room::class,
            Key::class,
            'room',
            'room_id',
            'employee_id',
            'employee'
        );
    }
}
