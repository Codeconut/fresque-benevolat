<?php

use App\Http\Controllers\FresqueController;
use App\Http\Controllers\FresqueApplicationController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Filament\Pages\Register;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FresqueApplicationFeedbackController;
use Filament\Http\Middleware\Authenticate;


Route::get('register', Register::class)
    ->name('filament.app.register')
    ->middleware('signed');

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/fresques-benevolat', [FresqueController::class, 'index'])->name('fresques.index');
Route::get('/fresques-benevolat/{fresque:slug}', [FresqueController::class, 'show'])->name('fresques.show');

Route::get('/fresques-benevolat/{fresque:slug}/candidate', [FresqueController::class, 'candidate'])->name('fresques.candidate');
Route::post('/fresques-benevolat/{fresque:slug}/apply', [FresqueController::class, 'apply'])->name('fresques.apply');
Route::post('/newsletter/contact', [NewsletterController::class, 'createOrUpdateContact'])->name('newsletter.sync.contact');

Route::get('/fresques-applications/{fresqueApplication:token}/registered', [FresqueApplicationController::class, 'registered'])->name('fresques.applications.registered');
Route::get('/fresques-applications/{fresqueApplication:token}/confirmation-presence', [FresqueApplicationController::class, 'confirmationPresence'])->name('fresques.applications.confirmation-presence');


Route::post('/fresques-applications/{fresqueApplication:token}/confirm', [FresqueApplicationController::class, 'confirm'])->name('fresques.applications.confirm');
Route::post('/fresques-applications/{fresqueApplication:token}/cancel', [FresqueApplicationController::class, 'cancel'])->name('fresques.applications.cancel');

Route::get('/fresques-applications/{fresqueApplication:token}/feedback', [FresqueApplicationController::class, 'feedback'])->name('fresques.applications.feedback');
Route::get('/fresques-applications/{fresqueApplication:token}/feedback-merci', [FresqueApplicationController::class, 'feedbackMerci'])->name('fresques.applications.feedback-merci');

Route::post('/fresques-applications/{fresqueApplication:token}/feedback', [FresqueApplicationFeedbackController::class, 'updateOrCreate'])->name('fresques.applications.feedback.updateOrCreate');

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
