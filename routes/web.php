<?php

use App\Http\Controllers\FresqueController;
use App\Http\Controllers\FresqueApplicationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/fresques-benevolat', [FresqueController::class, 'index'])->name('fresques.index');
Route::get('/fresques-benevolat/{fresque:slug}', [FresqueController::class, 'show'])->name('fresques.show');

Route::get('/fresques-benevolat/{fresque:slug}/candidate', [FresqueController::class, 'candidate'])->name('fresques.candidate');
Route::post('/fresques-benevolat/{fresque:slug}/apply', [FresqueController::class, 'apply'])->name('fresques.apply');

Route::get('/fresques-applications/{fresqueApplication:token}/confirm', [FresqueApplicationController::class, 'confirm'])->name('fresques.applications.confirm');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
// });
