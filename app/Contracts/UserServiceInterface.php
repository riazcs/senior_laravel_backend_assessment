<?php

namespace App\Contracts;

interface UserServiceInterface
{
    public function getAllUsers();
    public function getUserById($id);
    public function createUser(array $data);
    public function updateUser($id, array $data);
    public function softDeleteUser($id);
    public function restoreUser($id);
    public function permanentlyDeleteUser($id);
}
