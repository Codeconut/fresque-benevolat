<?php

namespace App\Http\Controllers;

use App\Models\Fresque;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home()
    {

        $fresques = Fresque::with(['animators', 'place'])->incoming()->online()->public()->orderBy('date', 'ASC')->paginate(6);

        return Inertia::render('Home', [
            'fresques' => $fresques,
        ]);
    }
}
