<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'FIO' => 'required|regex:/^[а-яА-ЯёЁ\s]+$/u',
            'email' => 'required|email|unique:users,email',
            'phone' => [
                'required',
                'regex:/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/',
            ],
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'telegram_user' => 'nullable|regex:/^@\w+$/'
        ];
    }
    public function messages(): array
    {
        return [
            'FIO.required' => 'Поле ФИО обязательно для заполнения.',
            'FIO.regex' => 'ФИО может содержать только буквы кириллицы и пробелы.',

            'email.required' => 'Поле Email обязательно для заполнения.',
            'email.email' => 'Введите корректный адрес электронной почты.',
            'email.unique' => 'Этот Email уже зарегистрирован.',

            'phone.required' => 'Поле Номер телефона обязательно для заполнения.',
            'phone.regex' => 'Введите номер телефона в формате +7(999)-999-99-99.',

            'password.required' => 'Поле Пароль обязательно для заполнения.',
            'password.min' => 'Пароль должен содержать не менее :min символов.',
            'password.regex' => 'Пароль должен содержать хотя бы одну заглавную букву, одну строчную букву, одну цифру и один специальный символ.',

            'telegram_user.regex' => 'Telegram username должен начинаться с @ и содержать только буквы, цифры или _.',
        ];

    }
}
