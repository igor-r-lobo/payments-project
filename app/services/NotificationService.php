<?php

namespace App\services;

use App\Interface\NotificationInterface;
use App\Interface\ClientInterface;

class NotificationService implements NotificationInterface
{
    private string $param;
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->param = \Hyperf\Support\env('PARAM_NOTIFICATION');
        $this->client = $client;
    }

    public function send(string $message): bool
    {
        return $this->request()["message"];
    }

    private function request()
    {
        $response = $this->client->request($this->param);

        return json_decode((string) $response->getBody(), true);
    }
}