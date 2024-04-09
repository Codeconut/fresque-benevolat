<?php

namespace App\Http\Controllers;

use App\Actions\CreateFresqueApplication;
use App\Http\Controllers\Controller;
use App\Models\Fresque;
use App\Models\FresqueApplication;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class FresqueController extends Controller
{

    public function index()
    {
        // $fresques = Fresque::with(['animators', 'place'])->incoming()->online()->public()->orderBy('date', 'ASC')->paginate(6);

        $fresques = QueryBuilder::for(Fresque::class)
            ->with(['animators', 'place'])
            ->incoming()
            ->online()
            ->public()
            ->allowedFilters(['place.city'])
            ->defaultSort('-date')
            ->paginate();

        $cities = Place::selectRaw('city, COUNT(*) as count')
            ->whereHas('fresques', function ($query) {
                $query->incoming()->online()->public();
            })
            ->groupBy('city')
            ->get();

        return Inertia::render('Fresques/Search', [
            'fresques' => $fresques,
            'cities' => $cities,
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
