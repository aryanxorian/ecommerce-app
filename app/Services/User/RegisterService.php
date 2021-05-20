<?php

namespace EcommerceApp\Services\User;

use EcommerceApp\Repository\User\UserRepository;
use EcommerceApp\Services\User\RegisterInterface;

class RegisterService implements RegisterInterface
{
    public function register($user)
    {
        $registerRepo = resolve(UserRepository::class);

        $registerData = $registerRepo->register($user);
        return $registerData;
    }
}