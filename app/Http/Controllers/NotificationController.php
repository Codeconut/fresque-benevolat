<?php

namespace App\Http\Controllers;

use App\Actions\CreateFresqueApplication;
use App\Http\Controllers\Controller;
use App\Models\Fresque;
use App\Models\FresqueApplication;
use App\Models\Place;
use App\Notifications\FresqueApplicationCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class NotificationController extends Controller
{

    public function fresqueApplicationCreated()
    {
        $fresque = Fresque::first();
        $notification = new FresqueApplicationCreated($fresque);

        $fresqueApplication = FresqueApplication::first();

        return $notification->toMail($fresqueApplication)->render();
    }
}
