<?php

namespace App\Http\Controllers;

use App\Actions\CreateFresqueApplication;
use App\Http\Controllers\Controller;
use App\Jobs\SendS3Feedback;
use App\Models\Fresque;
use App\Models\FresqueApplication;
use App\Models\Place;
use App\Notifications\FresqueApplicationCreated;
use App\Notifications\FresqueApplicationFeedbackJ3;
use App\Notifications\FresqueApplicationFeedbackS12;
use App\Notifications\FresqueApplicationFeedbackS3;
use App\Notifications\FresqueApplicationFeedbackS6;
use App\Notifications\FresqueApplicationReminderMorning;
use App\Notifications\FresqueApplicationReminderXDays;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class NotificationController extends Controller
{

    public function renderMail($slug)
    {

        $fresqueApplication = FresqueApplication::last();

        switch ($slug) {
            case 'fresque-application-feedback-j-3':
                $notification = new FresqueApplicationFeedbackJ3();
                $output = $notification->toMail($fresqueApplication)->render();
                break;
            case 'fresque-application-feedback-s-3':
                $notification = new FresqueApplicationFeedbackS3();
                $output = $notification->toMail($fresqueApplication)->render();

                SendS3Feedback::dispatch();

                break;
            case 'fresque-application-feedback-s-6':
                $notification = new FresqueApplicationFeedbackS6();
                $output = $notification->toMail($fresqueApplication)->render();
                break;
            case 'fresque-application-feedback-s-12':
                $notification = new FresqueApplicationFeedbackS12();
                $output = $notification->toMail($fresqueApplication)->render();
                break;
            case 'fresque-application-reminder-morning':
                $notification = new FresqueApplicationReminderMorning();
                $output = $notification->toMail($fresqueApplication)->render();
                break;
            case 'fresque-application-reminder-x-days':
                $notification = new FresqueApplicationReminderXDays();
                $output = $notification->toMail($fresqueApplication)->render();
                break;
            case 'fresque-application-created':
                $notification = new FresqueApplicationCreated();
                $output = $notification->toMail($fresqueApplication)->render();
                break;
            default:
                abort(404, 'Notification not found');
                break;
        }


        return $output;
    }
}
