<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animator;
use App\Models\Fresque;
use App\Models\FresqueApplication;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    public function kpis(Request $request)
    {
        return [
            'applications_validated_count' => FresqueApplication::where('state', 'validated')->count(),
            'fresques_passed_count' => Fresque::passed()->count(),
            'animators_count' => Animator::count(),
        ];
    }
}
