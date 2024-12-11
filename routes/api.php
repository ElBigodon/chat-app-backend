<?php

use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('/rooms')->group(function() {
    Route::get('/', [RoomController::class, 'index']);
    Route::post('/create', [RoomController::class, 'create']);
    Route::post('/join/{room}', [RoomController::class, 'join']);
    Route::get('/messages/{room}', [RoomController::class, 'messages']);
    Route::post('/message/{room}/{room_user}', [RoomController::class, 'message']);
});
