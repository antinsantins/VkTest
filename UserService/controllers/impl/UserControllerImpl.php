<?php

namespace src\UserService\controllers\impl;


use src\OrderService\controllers\UserController;

class UserControllerImpl extends UserController
{
    protected $userDao;

    public function __construct(UserDao $userDao)
    {
        $this->userDao = $userDao;
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        try {
            $user = $this->userDao->register(
                $request->email,
                $request->password
            );

            return response()->json(['message' => 'User registered successfully', 'user_id' => $user->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
