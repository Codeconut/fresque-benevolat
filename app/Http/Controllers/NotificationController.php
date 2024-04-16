<?php

namespace App\Http\Controllers;

use App\Actions\CreateFresqueApplication;
use App\Http\Controllers\Controller;
use App\Models\Fresque;
use App\Models\FresqueApplication;
use App\Models\Place;
use App\Notifications\FresqueApplicationCreated;
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
        $fresque = Fresque::first();
        $fresqueApplication = FresqueApplication::first();

        ray($slug);

        switch ($slug) {
            case 'fresque-application-reminder-morning':
                $notification = new FresqueApplicationReminderMorning($fresque);
                $output = $notification->toMail($fresqueApplication)->render();
                break;
            case 'fresque-application-reminder-x-days':
                $notification = new FresqueApplicationReminderXDays($fresque);
                $output = $notification->toMail($fresqueApplication)->render();
                break;
            case 'fresque-application-created':
                $notification = new FresqueApplicationCreated($fresque);
                $output = $notification->toMail($fresqueApplication)->render();
                break;
            default:
                abort(404, 'Notification not found');
                break;
        }


        return $output;
    }
}
