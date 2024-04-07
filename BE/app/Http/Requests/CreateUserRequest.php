<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'fullName' => 'required',
            'role' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'Email address already exists.',
            'fullName.required' => 'Full name is required.',
            'role.required' => 'Role is required.',
        ];
    }
}
