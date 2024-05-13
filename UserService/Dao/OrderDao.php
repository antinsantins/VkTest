<?php

namespace src\UserService\Dao;


class UserDao
{
    public function register($email, $password)
    {
        $user = new User();
        $user->email = $email;
        $user->password = bcrypt($password);

        $user->save();

        return $user;
    }
}