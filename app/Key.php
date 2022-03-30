<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{

    protected $table = 'key';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee', 'room',
    ];

    protected $primaryKey = 'key_id';
}
