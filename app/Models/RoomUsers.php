<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RoomUsers extends Model
{
    protected $table = "rooms_users";

    protected $fillable = [
        'name'
    ];

    public function room(): HasOne
    {
        return $this->hasOne(Room::class);
    }
}
