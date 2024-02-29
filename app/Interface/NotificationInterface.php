<?php

namespace App\Interface;

interface NotificationInterface
{
    public function send(string $message): bool;
}