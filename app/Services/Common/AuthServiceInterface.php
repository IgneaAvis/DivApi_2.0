<?php

namespace App\Services\Common;

interface AuthServiceInterface
{
    public function register(array $items);
    public function login(array $items);
}
