<?php

namespace App\Interface;

use Psr\Http\Message\ResponseInterface;

interface ClientInterface
{
    public function request(string $param): ResponseInterface;
}