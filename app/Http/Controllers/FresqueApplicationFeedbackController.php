<?php

namespace App\Http\Controllers;

use App\Actions\CreateFresqueApplication;
use App\Http\Controllers\Controller;
use App\Models\Fresque;
use App\Models\FresqueApplication;
use App\Models\FresqueApplicationFeedback;
use App\Notifications\FresqueApplicationCancel;
use App\Notifications\FresqueApplicationConfirmPresence;
use App\Notifications\FresqueApplicationFeedbackCreatedOrUpdated;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FresqueApplicationFeedbackController extends Controller
{
    public function updateOrCreate(Request $request, FresqueApplication $fresqueApplication)
    {

        ray($request->input('questions'));

        FresqueApplicationFeedback::updateOrCreate(
            ['fresque_application_id' => $fresqueApplication->id],
            [
                'fresque_application_id' => $fresqueApplication->id,
                'rating' => $request->input('rating'),
                'questions' => $request->input('questions'),
            ]
        );

        $fresqueApplication->notify(new FresqueApplicationFeedbackCreatedOrUpdated());

        return to_route('fresques.applications.feedback-merci', $fresqueApplication->token);
    }
}
