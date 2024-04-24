<?php

namespace App\Http\Controllers;

use App\Jobs\TriggerBrevoAction;
use App\Services\Brevo;
use Brevo\Client\Api\ContactsApi;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function createOrUpdateContact(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        TriggerBrevoAction::dispatch('createOrUpdateContact', [
            'email' => $request->input('email'),
            'updateEnabled' => true,
            'listIds' => [config('services.brevo.contacts_list_id')]
        ]);
    }
}
