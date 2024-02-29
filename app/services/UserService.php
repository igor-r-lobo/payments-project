<?php

namespace App\services;

use App\Interface\UserInterface;
use App\Model\User;


class UserService implements UserInterface
{
    private User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function store(Array $data)
    {
        return $this->user->create($data);
    }

    public function checkUserData(string $email, string $document): bool
    {
        $user = $this->user->where(["email" => $email]);

        if ($user->exists()){
            return true;
        }

        $user = $this->user->where(["document" => $document]);
        if ($user->exists()){
            return true;
        }

        return false;
    }

    public function checkUserValid(string $userId): bool
    {
        $user = $this->user->find($userId);
        return $user->exists;
    }

    public function getUserIdAndType(string $column, string $value): array
    {
        $user = $this->user->query()->where($column,$value)->first();

        return ["id" => $user->id, "type" => $user->account_type];
    }
}