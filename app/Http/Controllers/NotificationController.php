<?php

namespace App\Http\Controllers;

use App\Models\Animator;
use App\Models\FresqueApplication;
use App\Notifications\AnimatorHasAcceptedInvitation;
use App\Notifications\FresqueApplicationCreated;
use App\Notifications\FresqueApplicationFeedbackJ3;
use App\Notifications\FresqueApplicationFeedbackS12;
use App\Notifications\FresqueApplicationFeedbackS3;
use App\Notifications\FresqueApplicationFeedbackS6;
use App\Notifications\FresqueApplicationReminderMorning;
use App\Notifications\FresqueApplicationReminderXDays;

class NotificationController extends Controller
{
    public function renderMail($slug)
    {

        $fresqueApplication = FresqueApplication::first();
        $animator = Animator::first();

        switch ($slug) {
            case 'animator-has-accepted-invitation':
                $notification = new AnimatorHasAcceptedInvitation;
                $output = $notification->toMail($animator)->render();
                break;
            case 'fresque-application-feedback-j-3':
                $notification = new FresqueApplicationFeedbackJ3;
                $output = $notification->toMail($fresqueApplication)->render();
                break;
            case 'fresque-application-feedback-s-3':
                $notification = new FresqueApplicationFeedbackS3;
                $output = $notification->toMail($fresqueApplication)->render();
                break;
            case 'fresque-application-feedback-s-6':
                $notification = new FresqueApplicationFeedbackS6;
                $output = $notification->toMail($fresqueApplication)->render();
                break;
            case 'fresque-application-feedback-s-12':
                $notification = new FresqueApplicationFeedbackS12;
                $output = $notification->toMail($fresqueApplication)->render();
                break;
            case 'fresque-application-reminder-morning':
                $notification = new FresqueApplicationReminderMorning;
                $output = $notification->toMail($fresqueApplication)->render();
                break;
            case 'fresque-application-reminder-x-days':
                $notification = new FresqueApplicationReminderXDays;
                $output = $notification->toMail($fresqueApplication)->render();
                break;
            case 'fresque-application-created':
                $notification = new FresqueApplicationCreated;
                $output = $notification->toMail($fresqueApplication)->render();
                break;
            default:
                abort(404, 'Notification not found');
                break;
        }

        return $output;
    }
}
