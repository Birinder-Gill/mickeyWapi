<?php

use App\Http\Controllers\WapiController;
use App\Http\Middleware\DetectDeleteMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/onMessageCreate', [WapiController::class, 'onMessageCreate'])->middleware([DetectDeleteMiddleware::class]);
Route::get('/test', [WapiController::class, 'test']);
Route::get('/sendMessage', [WapiController::class, 'sendMessage']);


