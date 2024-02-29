<?php

namespace App\Interface;

interface TransactInterface
{
    public function deposit(Array $data);
    public function transfer(Array $data);
}