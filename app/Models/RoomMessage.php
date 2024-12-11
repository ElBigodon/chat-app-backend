<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomMessage extends Model
{
    protected $table = 'rooms_messages';

    protected $fillable = [
        'content',
        'user_id',
        'room_id'
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(RoomUsers::class);
    }

    public function room(): BelongsTo
    {
        return $this->BelongsTo(Room::class);
    }
    
}
