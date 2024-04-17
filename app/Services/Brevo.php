<?php

namespace App\Services;

use GuzzleHttp\Client;
use Brevo\Client\Api\ContactsApi;
use Brevo\Client\Configuration;

class Brevo
{

    public static function createContact($attributes = [])
    {
        if (empty($attributes)) {
            return;
        }
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', config('services.brevo.api_key'));

        $apiInstance = new ContactsApi(
            new Client(),
            $config
        );
        $createContact = new \Brevo\Client\Model\CreateContact($attributes);

        try {
            $apiInstance->createContact($createContact);
        } catch (\Exception $e) {
            abort(422, 'An error occurred while trying to add your email to the newsletter list. ' . $e->getMessage());
        }
    }
}
