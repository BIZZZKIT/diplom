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
            'password' => 'required|min:8',
        ];
    }
    public function messages(): array
    {
        return [
            'FIO.required' => 'Поле ФИО обязательно для заполнения.',
            'FIO.regex' => 'Поле ФИО может содержать только буквы кириллицы и пробелы.',

            'email.required' => 'Поле Email обязательно для заполнения.',
            'email.email' => 'Введите корректный адрес электронной почты.',
            'email.unique' => 'Этот Email уже зарегистрирован.',

            'password.required' => 'Поле Пароль обязательно для заполнения.',
            'password.min' => 'Пароль должен содержать не менее :min символов.',
        ];

    }
}
