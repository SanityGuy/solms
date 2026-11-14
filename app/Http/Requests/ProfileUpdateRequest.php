<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = $this->user();

        $rules = [
            'display_name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
        ];

        if ($user->isAdmin()) {
            $rules['email'] = [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
                'regex:/^[a-zA-Z0-9._%+-]+@solms\.id$/i',
            ];

            $rules['current_password'] = [
                Rule::requiredIf($this->input('email') !== $user->email),
                'current_password',
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'email.regex' => 'Email must end with @solms.id.',
            'current_password.required' => 'Your current password is required to change your email.',
            'current_password.current_password' => 'Your current password is incorrect.',
        ];
    }
}
