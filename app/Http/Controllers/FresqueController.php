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
        $fresques = Fresque::with(['animators', 'place'])->incoming()->online()->paginate(2);

        return Inertia::render('Fresques/Search', [
            'fresques' => $fresques,
        ]);
    }

    public function show(Fresque $fresque)
    {

        $fresque->load(['animators', 'place']);

        return Inertia::render('Fresques/Show', [
            'fresque' => $fresque,
        ]);
    }

    public function candidate(Request $request, Fresque $fresque, CreateFresqueApplication $createFresqueApplication)
    {

        if (!$fresque->can_candidate) {
            return redirect()->back()->with('error', 'Les candidatures pour cette fresque sont fermées');
        }

        $inputs = [
            'fresque_id' => $fresque->id,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ];

        $createFresqueApplication->apply($inputs);

        // return success message;
        return redirect()->back()->with('success', 'Votre candidature a bien été enregistrée');
    }
}
