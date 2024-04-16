<?php

use App\Http\Controllers\FresqueController;
use App\Http\Controllers\FresqueApplicationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Filament\Pages\Register;
use App\Http\Controllers\NotificationController;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/fresques-benevolat', [FresqueController::class, 'index'])->name('fresques.index');
Route::get('/fresques-benevolat/{fresque:slug}', [FresqueController::class, 'show'])->name('fresques.show');

Route::get('/fresques-benevolat/{fresque:slug}/candidate', [FresqueController::class, 'candidate'])->name('fresques.candidate');
Route::post('/fresques-benevolat/{fresque:slug}/apply', [FresqueController::class, 'apply'])->name('fresques.apply');

Route::get('/fresques-applications/{fresqueApplication:token}/confirmation', [FresqueApplicationController::class, 'confirmation'])->name('fresques.applications.confirmation');
Route::get('/fresques-applications/{fresqueApplication:token}/presence', [FresqueApplicationController::class, 'presence'])->name('fresques.applications.presence');


Route::get('register', Register::class)
    ->name('filament.app.register')
    ->middleware('signed');

Route::middleware([
    Authenticate::class,
])->group(function () {
    Route::get('/notifications/{slug}', [NotificationController::class, 'renderMail']);
});


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
// });
