<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorisationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ]
        ];
    }
    public function messages(): array
    {
        return [

            'email.required' => 'Поле Email обязательно для заполнения.',
            'email.email' => 'Введите корректный адрес электронной почты.',
            'email.unique' => 'Этот Email уже зарегистрирован.',

            'password.required' => 'Поле Пароль обязательно для заполнения.',
            'password.min' => 'Пароль должен содержать не менее :min символов.',
            'password.regex' => 'Пароль должен содержать хотя бы одну заглавную букву, одну строчную букву, одну цифру и один специальный символ.',
        ];

    }
}
