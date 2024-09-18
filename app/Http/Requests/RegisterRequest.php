<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255|unique:users,email',
            'name' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
        ];
    }
}
