<?php

namespace App\Service;

interface UserService
{
    function login(string $user, string $password): bool;
}
