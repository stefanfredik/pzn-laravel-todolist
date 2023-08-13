<?php

namespace App\Service\Impl;


use App\Service\UserService;

class UserServiceImpl implements UserService
{
    private array  $users = [
        "fredik" => "rahasia"
    ];

    function login(string $user, string $password): bool
    {
        if (!isset($this->users[$user])) {
            return false;
        }

        $correctPassword = $this->users[$user];
        return $password == $correctPassword;
    }
}
