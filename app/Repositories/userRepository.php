<?php

namespace App\Repositories;

use App\Repositories\userRepositoryInterface;
use App\Models\User;

class userRepository implements userRepositoryInterface
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserInfo($id)
    {
        return User::findOrFail($id);
    }

    public function registerNewUser($input)
    {
        return User::create($input);
    }

    public function deleteUser($api_token)
    {
        User::where('api_token', $api_token)->delete();
    }

    public function updateUser($input, $id)
    {
        return User::whereId($id)->update($input);
    }
}
