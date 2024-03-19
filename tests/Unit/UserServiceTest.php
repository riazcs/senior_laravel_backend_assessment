<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    protected $userService;

    public function setUp(): void
    {
        parent::setUp();
        $this->userService = new UserService();
    }

    public function testCreateUser()
    {
        $userService = new UserService();
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
        ];

        $user = $userService->createUser($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userData['name'], $user->name);
        $this->assertEquals($userData['email'], $user->email);
    }


    public function testUpdateUser()
    {
        $userData = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'oldpassword',
        ];
        $user = User::create($userData);

        $updatedEmail = 'updated@example.com';
        $updatedUserData = array_merge($userData, ['email' => $updatedEmail]);
        $userService = new UserService();
        $updatedUser = $userService->updateUser($user->id, $updatedUserData);

        $this->assertInstanceOf(User::class, $updatedUser);
        $this->assertEquals($updatedEmail, $updatedUser->email);
    }

    public function testUserList()
    {
        $users = $this->userService->getAllUsers();
        $this->assertCount(3, $users);
    }

    public function it_can_soft_delete_user()
    {
        $userData = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'oldpassword',
        ];
        $user = User::create($userData);
        $this->userService->softDeleteUser($user->id);
        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }

    public function it_can_restore_permanent_deleted_user()
    {
        $userData = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'oldpassword',
        ];
        $user = User::create($userData);
        $user->delete();
        $this->userService->restoreUser($user->id);
        $this->userService->permanentlyDeleteUser($user->id);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'deleted_at' => null]);
    }
}
