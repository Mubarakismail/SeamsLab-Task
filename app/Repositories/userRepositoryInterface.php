<?php

namespace App\Repositories;

interface userRepositoryInterface
{
    public function getAllUsers();
    public function registerNewUser($input);
    public function getUserInfo($api_token);
    public function deleteUser($api_token);
    public function updateUser($input, $api_token);
}
