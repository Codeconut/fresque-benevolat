<?php

use App\Http\Controllers\Api\GlobalController;
use App\Http\Controllers\Api\SlackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/slack/interactivity', [SlackController::class, 'interactivity']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/global/kpis', [GlobalController::class, 'kpis'])->name('global.kpis');
