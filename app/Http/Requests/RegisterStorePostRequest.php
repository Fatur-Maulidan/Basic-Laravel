<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public static function registerRules(): array
    {
        return [
            'username' => 'required|unique:auth|alpha|min:3',
            'password' => 'required|alpha_num|min:8'
        ];
    }

    public static function loginRules(): array
    {
        return [
            'username' => 'required|alpha|min:3',
            'password' => 'required|alpha_num|min:8'
        ];
    }

    public static function message(): array
    {
        return [
            'username.required' => 'Field username harus diisi.',
            'password.required' => 'Field password harus diisi.'
        ];
    }
}