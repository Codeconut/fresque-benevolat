<?php

namespace App\Http\Controllers;

use App\Models\FresqueApplication;
use App\Models\FresqueApplicationFeedback;
use App\Notifications\FresqueApplicationFeedbackCreatedOrUpdated;
use Illuminate\Http\Request;

class FresqueApplicationFeedbackController extends Controller
{
    public function updateOrCreate(Request $request, FresqueApplication $fresqueApplication)
    {

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
