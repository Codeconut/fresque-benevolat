<?php

namespace App\Http\Controllers;

use App\Actions\CreateFresqueApplication;
use App\Jobs\TriggerBrevoAction;
use App\Models\Fresque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class FresqueController extends Controller
{
    public function index()
    {
        $fresques = QueryBuilder::for(Fresque::class)
            ->with(['animators', 'place'])
            ->incoming()
            ->online()
            ->public()
            ->allowedFilters(['place.city'])
            ->defaultSort('-date')
            ->paginate();

        $cities = Fresque::select('places.city', DB::raw('COUNT(*) as count'))
            ->join('places', 'places.id', '=', 'fresques.place_id')
            ->incoming()->online()->public()
            ->groupBy('places.city')
            ->get()->toArray();

        return Inertia::render('Fresques/Search', [
            'fresques' => $fresques,
            'oldFresques' => Fresque::with(['place'])->online()->public()->passed()->limit(10)->orderBy('date', 'DESC')->get(),
            'cities' => $cities,
        ]);
    }

    public function show(Fresque $fresque)
    {
        $fresque->load(['animators', 'place']);

        if (! $fresque->is_online) {
            if (! Auth::check()) {
                abort(401);
            } elseif (! Auth::user()->hasRole('admin')) {
                abort(401);
            }
        }

        return Inertia::render('Fresques/Show', [
            'fresque' => $fresque,
            'fresquesAlentours' => Fresque::with(['place'])
                ->where('id', '!=', $fresque->id)
                ->incoming()
                ->online()
                ->public()->take(3)->get(),
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
        if (! $fresque->can_candidate) {
            return redirect()->back()->with('error', 'Les candidatures pour cette fresque sont fermées');
        }

        $inputs = [
            'fresque_id' => $fresque->id,
            ...$request->only('email', 'first_name', 'mobile', 'last_name', 'has_accepted_emails', 'info_benevolat', 'info_fresque'),
        ];

        $application = $createFresqueApplication->apply($inputs);

        $application->notify(new \App\Notifications\FresqueApplicationCreated);

        TriggerBrevoAction::dispatch('createOrUpdateContact', [
            'email' => $request->input('email'),
            'updateEnabled' => true,
            'listIds' => [config('services.brevo.contacts_list_id')],
        ]);

        return to_route('fresques.applications.registered', $application->token);
    }
}
