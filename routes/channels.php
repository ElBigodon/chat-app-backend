<?php

use App\Models\RoomConnectUsers;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('Message.Received.{room_id}.{id}', function ($user, $room_id, $id) {
    return true;
});
