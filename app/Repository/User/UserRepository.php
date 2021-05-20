<?php

namespace EcommerceApp\Repository\User;

use EcommerceApp\Models\User;
use EcommerceApp\Repository\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function register($user)
    {
        // $saveHistory = DB::table('users')->insert(
        //     ['name' => $user['name'], 'email' => $user['email'], 'password' => Hash::make($user['password'])]
        // );
        $this->user->name = $user['name'];
        $this->user->email = $user['email'];
        $this->user->password = Hash::make($user['password']);
        $this->user->save();
        
        return $this->user;
    }
}