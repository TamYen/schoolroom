<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomSession extends Model
{
    protected $fillable = ['room', 'shift', 'creater', 'date'];
}
