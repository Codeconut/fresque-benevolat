<?php

namespace App\Http\Controllers;

use App\Actions\CreateFresqueApplication;
use App\Http\Controllers\Controller;
use App\Models\Fresque;
use App\Models\FresqueApplication;
use App\Notifications\FresqueApplicationCancel;
use App\Notifications\FresqueApplicationConfirmPresence;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FresqueApplicationController extends Controller
{
    public function registered(FresqueApplication $fresqueApplication)
    {
        $fresque = $fresqueApplication->fresque->load(['place']);

        return Inertia::render('Applications/Registered', [
            'fresque' =>  $fresque,
        ]);
    }

    public function confirmationPresence(FresqueApplication $fresqueApplication)
    {
        $fresque = $fresqueApplication->fresque->load(['place']);

        return Inertia::render('Applications/ConfirmationPresence', [
            'fresque' =>  $fresque,
            'token' =>  $fresqueApplication->token,
            'application' => $fresqueApplication,
        ]);
    }

    public function confirm(FresqueApplication $fresqueApplication)
    {
        $fresqueApplication->update([
            'state' => 'confirmed_presence',
        ]);

        $fresqueApplication->notify(new FresqueApplicationConfirmPresence($fresqueApplication->fresque));

        return to_route('fresques.applications.confirmation-presence', $fresqueApplication->token);
    }

    public function cancel(FresqueApplication $fresqueApplication)
    {
        $fresqueApplication->update([
            'state' => 'canceled',
        ]);

        $fresqueApplication->notify(new FresqueApplicationCancel($fresqueApplication->fresque));

        return to_route('fresques.applications.confirmation-presence', $fresqueApplication->token);
    }
}
