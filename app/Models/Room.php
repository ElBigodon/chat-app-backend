<?php

namespace App\Models;

use Hash;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'owner_id',
        'code',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(RoomMessage::class, 'room_id', 'id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(RoomConnectUsers::class, 'room_id', 'id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(RoomUsers::class, 'id');
    }

}
