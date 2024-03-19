<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    protected $id;
    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
