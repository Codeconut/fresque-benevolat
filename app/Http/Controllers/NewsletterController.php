<?php

namespace App\Http\Controllers;

use App\Jobs\TriggerBrevoAction;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function createOrUpdateContact(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'type' => 'required|in:contact,waiting-list',
        ]);

        if ($request->input('type') === 'waiting-list') {
            $listIds = [config('services.brevo.contacts_waiting_list_id')];
        }

        if ($request->input('type') === 'contact') {
            $listIds = [config('services.brevo.contacts_list_id')];
        }

        TriggerBrevoAction::dispatch('createOrUpdateContact', [
            'email' => $request->input('email'),
            'updateEnabled' => true,
            'listIds' => $listIds,
        ]);
    }
}
