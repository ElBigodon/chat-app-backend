<?php

use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('/room')->group(function() {
    Route::get('', [RoomController::class, 'index']);
    Route::post('create', [RoomController::class, 'create']);
});
