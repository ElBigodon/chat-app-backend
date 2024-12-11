<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomConnectUsers extends Model
{
    protected $table = "rooms_connect_users";

    protected $fillable = [
        'room_id',
        'user_id'
    ];
}
