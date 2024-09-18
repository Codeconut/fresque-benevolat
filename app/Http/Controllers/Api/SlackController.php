<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SlackController extends Controller
{
    public function interactivity(Request $request)
    {
        $payload = json_decode($request->payload);

        ray('slack interactivity', $payload);
    }
}
