<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

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
