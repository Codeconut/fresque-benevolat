<?php

namespace App\Services;

use GuzzleHttp\Client;
use Brevo\Client\Api\ContactsApi;
use Brevo\Client\Configuration;

class Brevo
{
    protected $config;
    protected $contactsApiInstance;

    public function __construct()
    {
        $this->config = Configuration::getDefaultConfiguration()->setApiKey('api-key', config('services.brevo.api_key'));
        $this->contactsApiInstance = new ContactsApi(
            new Client(),
            $this->config
        );
    }

    public function createOrUpdateContact($attributes = [])
    {
        if (empty($attributes)) {
            return;
        }

        $createContact = new \Brevo\Client\Model\CreateContact($attributes);

        try {
            $this->contactsApiInstance->createContact($createContact);
        } catch (\Exception $e) {
            abort(422, 'An error occurred while trying to add your email to the newsletter list. ' . $e->getMessage());
        }
    }
}
