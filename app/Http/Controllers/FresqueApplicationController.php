<?php

namespace App\Http\Controllers;

use App\Actions\CreateFresqueApplication;
use App\Http\Controllers\Controller;
use App\Models\Fresque;
use App\Models\FresqueApplication;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FresqueApplicationController extends Controller
{
    public function confirmation(FresqueApplication $fresqueApplication)
    {
        $fresque = $fresqueApplication->fresque->load(['place']);

        return Inertia::render('Applications/Confirmation', [
            'fresque' =>  $fresque,
        ]);
    }

    public function presence(FresqueApplication $fresqueApplication)
    {
        $fresque = $fresqueApplication->fresque->load(['place']);

        return Inertia::render('Applications/Presence', [
            'fresque' =>  $fresque,
            'application' => $fresqueApplication,
        ]);
    }
}
