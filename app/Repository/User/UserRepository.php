<?php

namespace EcommerceApp\Repository\User;

use EcommerceApp\Models\User;
use EcommerceApp\Models\UsersRole;
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

        $users_roles = new UsersRole();

        $this->user->name = $user['name'];
        $this->user->mobile = $user['mobile'];
        $this->user->email = $user['email'];
        $this->user->password = Hash::make($user['password']);
        $this->user->type = $user['type'];
        $this->user->save();

        if($user['type'] == 1)
        {
            $users_roles->user_id = $this->user->id;
            $users_roles->role_id = 2;
            $users_roles->save();

            return $this->user;
        }

        $users_roles->user_id = $this->user->id;
        $users_roles->role_id = 1;
        $users_roles->save();
        
        return $this->user;
    }
}