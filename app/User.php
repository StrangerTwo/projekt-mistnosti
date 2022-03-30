<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $table = 'employee';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'job', 'wage', 'login', 'password'
    ];

    protected $hidden = [
        'password',
    ];

    protected $primaryKey = 'employee_id';

    public function getEmailAttribute() {
        return $this->login;
    }
  
    public function setEmailAttribute($value)
    {
      $this->attributes['login'] = strtolower($value);
    }

    public function room()
    {
        return Room::find($this->room);
        // return $this->belongsTo(Room::class, 'room_id', 'room');
    }

    public function keys()
    {
        return DB::table('key')
            ->join('room', 'room', '=', 'room_id')
            ->where('employee', '=', $this->employee_id)
            ->select('room.*')
            ->get();
    }
}
