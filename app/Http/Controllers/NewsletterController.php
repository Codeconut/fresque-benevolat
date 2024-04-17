<?php

namespace App\Http\Controllers;

use App\Services\Brevo;
use Brevo\Client\Api\ContactsApi;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function createContact(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        Brevo::createContact([
            'email' => $request->input('email'),
            'updateEnabled' => true,
            'listIds' => [631]
        ]);
    }
}
