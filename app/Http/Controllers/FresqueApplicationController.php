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
    public function confirm(FresqueApplication $fresqueApplication)
    {
        return Inertia::render('Applications/Confirm', [
            'application' => $fresqueApplication,
        ]);
    }
}
