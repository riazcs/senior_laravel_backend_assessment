<?php

namespace App\Http\Controllers;

use App\Contracts\UserServiceInterface;
use App\Events\UserSaved;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('profile_photo')) {
            $imagePath = $request->file('profile_photo')->move('images');
            $data['profile_photo'] = $imagePath;
        }
        
        $data['password'] = Hash::make($request->input('password'));
        $user = $this->userService->createUser($data);
        event(new UserSaved($user));
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->userService->getUserById($id);
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->validated();
        if ($request->hasFile('profile_photo')) {
            $imagePath = $request->file('profile_photo')->move('images');
            $data['profile_photo'] = $imagePath;
        }
        $this->userService->updateUser($id, $data);
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $this->userService->softDeleteUser($id);
        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function restore($id)
    {
        $this->userService->restoreUser($id);
        return redirect()->route('users.index')->with('success', 'User restored successfully');
    }

    public function permanentlyDelete($userId)
    {
        $this->userService->permanentlyDeleteUser($userId);
        return redirect()->route('users.index')->with('success', 'User permanently deleted');
    }
}
