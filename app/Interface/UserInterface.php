<?php

namespace App\Interface;

interface UserInterface
{
    public function store(Array $data);

    public function checkUserData(string $email, string $document);

    public function checkUserValid(string $userId);

    public function getUserIdAndType(string $column, string $value): array;
}