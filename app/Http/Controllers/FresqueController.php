<?php

namespace App\Http\Controllers;

use App\Actions\CreateFresqueApplication;
use App\Http\Controllers\Controller;
use App\Models\Fresque;
use App\Models\FresqueApplication;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FresqueController extends Controller
{

    public function index(Fresque $fresque)
    {
        $fresques = Fresque::with(['animators', 'place'])->incoming()->online()->public()->paginate(6);

        return Inertia::render('Fresques/Search', [
            'fresques' => $fresques,
        ]);
    }

    public function show(Fresque $fresque)
    {

        // $application = FresqueApplication::latest()->first();
        // $application->notify(new \App\Notifications\FresqueApplicationCreated($fresque));
        // $application->notify(new \App\Notifications\FresqueApplicationConfirmPresence($fresque));

        $fresque->load(['animators', 'place']);

        return Inertia::render('Fresques/Show', [
            'fresque' => $fresque,
        ]);
    }

    public function candidate(Fresque $fresque)
    {
        $fresque->load(['place']);

        return Inertia::render('Fresques/Candidate', [
            'fresque' => $fresque,
        ]);
    }

    public function apply(Request $request, Fresque $fresque, CreateFresqueApplication $createFresqueApplication)
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

        $application = $createFresqueApplication->apply($inputs);

        $application->notify(new \App\Notifications\FresqueApplicationCreated($fresque));

        return to_route('fresques.applications.confirmation', $application->token);
    }
}
