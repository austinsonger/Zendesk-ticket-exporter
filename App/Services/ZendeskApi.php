<?php

namespace App\Services;

use GuzzleHttp\Client;

class ZendeskApi
{
    public function __construct(string $subdomain, string $email, string $token)
    {
        $this->client = new Client([
            'base_uri' => 'https://' . $subdomain . '.zendesk.com/api/v2/',
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($email . '/token:' . $token),
            ],
        ]);
    }

    public function getTickets()
    {
        $response = $this->client->get('tickets');
        $content = $response->getBody()->getContents();
        return json_decode($content, true)['tickets'];
    }
}