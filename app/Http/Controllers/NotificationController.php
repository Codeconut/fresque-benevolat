<?php

namespace App\Http\Controllers;

use App\Models\Fresque;
use App\Models\FresqueApplication;
use App\Models\User;
use App\Notifications\FresqueApplicationCreated;
use App\Notifications\FresqueApplicationFeedbackJ3;
use App\Notifications\FresqueApplicationFeedbackS12;
use App\Notifications\FresqueApplicationFeedbackS3;
use App\Notifications\FresqueApplicationFeedbackS6;
use App\Notifications\FresqueApplicationReminderMorning;
use App\Notifications\FresqueApplicationReminderXDays;
use App\Notifications\UserAnimatorFresquePassed1Day;
use App\Notifications\UserAnimatorFresqueReminderIn2Days;
use App\Notifications\UserAnimatorHasAcceptedInvitation;

class NotificationController extends Controller
{
    public function renderMail($slug)
    {
        $fresque = Fresque::first();
        $fresqueApplication = FresqueApplication::first();
        $userAnimator = User::whereHas('animator')->first();

        switch ($slug) {
            case 'user-animator-fresque-passed-1-day':
                $notification = new UserAnimatorFresquePassed1Day($fresque);
                $output = $notification->toMail($userAnimator)->render();
                break;
            case 'user-animator-fresque-reminder-in-2-days':
                $notification = new UserAnimatorFresqueReminderIn2Days($fresque);
                $output = $notification->toMail($userAnimator)->render();
                break;
            case 'user-animator-has-accepted-invitation':
                $notification = new UserAnimatorHasAcceptedInvitation;
                $output = $notification->toMail($userAnimator)->render();
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
