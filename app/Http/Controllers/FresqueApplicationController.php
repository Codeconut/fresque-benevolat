<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fresque;
use App\Models\FresqueApplication;
use App\Models\FresqueApplicationFeedback;
use App\Notifications\FresqueApplicationCancel;
use App\Notifications\FresqueApplicationConfirmPresence;
use App\Notifications\FresqueApplicationPostFresqueEngagementUpdated;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FresqueApplicationController extends Controller
{
    public function registered(FresqueApplication $fresqueApplication)
    {
        $fresque = $fresqueApplication->fresque->load(['place']);

        return Inertia::render('Applications/Registered', [
            'fresque' =>  $fresque,
            'application' => $fresqueApplication,
        ]);
    }

    public function confirmationPresence(FresqueApplication $fresqueApplication)
    {
        $fresque = $fresqueApplication->fresque->load(['place']);

        return Inertia::render('Applications/ConfirmationPresence', [
            'fresque' =>  $fresque,
            'token' =>  $fresqueApplication->token,
            'application' => $fresqueApplication,
        ]);
    }

    public function confirm(FresqueApplication $fresqueApplication)
    {
        $fresqueApplication->update([
            'state' => 'confirmed_presence',
        ]);

        $fresqueApplication->notify(new FresqueApplicationConfirmPresence());

        return to_route('fresques.applications.confirmation-presence', $fresqueApplication->token);
    }

    public function cancel(FresqueApplication $fresqueApplication)
    {
        $fresqueApplication->update([
            'state' => 'canceled',
        ]);

        $fresqueApplication->notify(new FresqueApplicationCancel());

        return to_route('fresques.applications.confirmation-presence', $fresqueApplication->token);
    }

    public function feedback(FresqueApplication $fresqueApplication)
    {
        $fresque = $fresqueApplication->fresque->load(['place']);

        return Inertia::render('Applications/Feedback', [
            'fresque' =>  $fresque,
            'token' =>  $fresqueApplication->token,
            'application' => $fresqueApplication,
            'feedback' => $fresqueApplication->feedback,
        ]);
    }

    public function feedbackMerci(FresqueApplication $fresqueApplication)
    {
        $fresque = $fresqueApplication->fresque->load(['place']);

        return Inertia::render('Applications/FeedbackMerci', [
            'fresque' =>  $fresque,
            'token' =>  $fresqueApplication->token,
            'application' => $fresqueApplication,
            'feedback' => $fresqueApplication->feedback,
        ]);
    }

    public function engagement(FresqueApplication $fresqueApplication)
    {
        $fresque = $fresqueApplication->fresque->load(['place']);

        return Inertia::render('Applications/Engagement', [
            'fresque' =>  $fresque,
            'token' =>  $fresqueApplication->token,
            'application' => $fresqueApplication,
        ]);
    }

    public function engagementMerci(FresqueApplication $fresqueApplication)
    {
        $fresque = $fresqueApplication->fresque->load(['place']);

        return Inertia::render('Applications/EngagementMerci', [
            'fresque' =>  $fresque,
            'token' =>  $fresqueApplication->token,
            'application' => $fresqueApplication,
        ]);
    }

    public function engagementBenevolat(Request $request, FresqueApplication $fresqueApplication)
    {
        $request->validate([
            'post_fresque_engagement' => 'required|in:yes,no_but_soon,not_yet',
        ], [
            'post_fresque_engagement.required' => 'Veuillez indiquer si vous souhaitez vous engager bénévolement.',
            'post_fresque_engagement.in' => 'La valeur indiquée pour l\'engagement bénévole est invalide.',
        ]);

        $fresqueApplication->update([
            'post_fresque_engagement' => $request->input('post_fresque_engagement'),
        ]);

        $fresqueApplication->notify(new FresqueApplicationPostFresqueEngagementUpdated());

        return to_route('fresques.applications.engagement-merci', $fresqueApplication->token);
    }
}
