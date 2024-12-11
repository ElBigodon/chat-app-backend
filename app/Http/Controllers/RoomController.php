<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoomFormRequest;
use App\Http\Requests\CreateRoomMessageFormRequest;
use App\Http\Requests\CreateRoomUserFormRequest;
use App\Models\Room;
use App\Models\RoomConnectUsers;
use App\Models\RoomMessage;
use App\Models\RoomUsers;
use Illuminate\Http\Request;
use Str;

class RoomController extends Controller
{
    //

    public function index()
    {
        return response()->json(Room::with(['owner', 'users'])->get());
    }

    public function create(CreateRoomFormRequest $request)
    {
        $code = Str::random(6);

        $owner = RoomUsers::create([
            'name' => $request->validated('owner'),
        ]);

        $room = Room::create([
            'name' => $request->validated('name'),
            'owner_id' => $owner->id,
            'code' => $code,
        ]);

        RoomConnectUsers::create([
            'user_id' => $owner->id,
            'room_id' => $room->id
        ]);

        return response()->json($room->with(['owner', 'users'])->firstWhere('id', $room->id));
    }
    
    public function join(Room $room, CreateRoomUserFormRequest $request)
    {
        $user = RoomUsers::firstOrCreate($request->validated());

        RoomConnectUsers::firstOrCreate([
            'user_id' => $user->id,
            'room_id' => $room->id
        ]);
        
        $room->owner_id = $user->id;

        $room->save();

        return response()->json($room->with(['owner', 'users', 'messages'])->firstWhere('id', $room->id));
    }

    public function message(Room $room, RoomUsers $room_user, CreateRoomMessageFormRequest $request)
    {
        $message = RoomMessage::create([
            'user_id'=> $room_user->id,
            'room_id' => $room->id,
            'content' => $request->validated('content')
        ]);

        return response()->json($message->with(['user', 'room'])->firstWhere('id', $message->id));
    }

    public function messages(Room $room)
    {
        return response()->json(
            RoomMessage::with(['user', 'room.owner'])
            ->where('room_id', $room->id)
            ->oldest()
            ->get()
        );
    }
}
