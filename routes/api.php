<?php

use App\Http\Controllers\WapiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/onMessageCreate', [WapiController::class, 'onMessageCreate']);
Route::get('/test', [WapiController::class, 'test']);
Route::get('/sendMessage', [WapiController::class, 'sendMessage']);


