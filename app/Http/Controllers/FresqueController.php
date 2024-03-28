<?php

namespace App\Http\Controllers;

use App\Actions\CreateFresqueApplication;
use App\Http\Controllers\Controller;
use App\Models\Fresque;
use Illuminate\Http\Request;
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

    public function candidate(Request $request, Fresque $fresque, CreateFresqueApplication $createFresqueApplication)
    {

        $inputs = [
            'fresque_id' => $fresque->id,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ];

        $createFresqueApplication->apply($inputs);

        return redirect()->back()->with([
            'success' => 1,
        ]);
    }
}
