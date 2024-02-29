<?php

namespace App\Http;
use App\Interface\ClientInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;


class GuzzleClient implements ClientInterface
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => \Hyperf\Support\env("URL_CLIENT")]);
    }

    public function request(string $param): ResponseInterface
    {
        return $this->client->get($param);
    }
}