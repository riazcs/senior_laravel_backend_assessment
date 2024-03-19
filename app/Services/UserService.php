<?php

namespace App\Services;

use App\Contracts\UserServiceInterface;
use App\Models\User;

class UserService implements UserServiceInterface
{
    public function getAllUsers()
    {
        return User::withTrashed()->get();
    }

    public function getUserById($id)
    {
        return User::with('addresses')->findOrFail($id);
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function updateUser($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function softDeleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
    }

    public function permanentlyDeleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->forceDelete();
    }
}
