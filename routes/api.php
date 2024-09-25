<?php

use App\Http\Controllers\Api\GlobalController;
use App\Http\Controllers\Api\SlackController;
use Illuminate\Support\Facades\Route;

Route::post('/slack/interactivity', [SlackController::class, 'interactivity']);
Route::get('/global/kpis', [GlobalController::class, 'kpis'])->name('global.kpis');
