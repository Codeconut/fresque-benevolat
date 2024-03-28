<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fresque;
use Inertia\Inertia;

class FresqueController extends Controller
{

    public function index(Fresque $fresque)
    {
        $fresques = Fresque::with(['animators', 'address'])->incoming()->online()->paginate(2);

        return Inertia::render('Fresques/Search', [
            'fresques' => $fresques,
        ]);
    }

    public function show(Fresque $fresque)
    {

        $fresque->load(['animators', 'address']);

        return Inertia::render('Fresques/Show', [
            'fresque' => $fresque,
        ]);
    }
}
