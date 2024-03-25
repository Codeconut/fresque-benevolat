<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home()
    {
        return Inertia::render('Home');
    }

    public function fresquesBenevolat()
    {
        return Inertia::render('FresquesBenevolat');
    }
}
