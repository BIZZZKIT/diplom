<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'FIO' => 'required|string|max:255|regex:/^[а-яА-ЯёЁ\s]+$/u',
            'phone' => 'required|string|max:255|regex:/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'telegram_user' => 'nullable|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'FIO.required' => 'Поле ФИО обязательно для заполнения.',
            'FIO.string' => 'ФИО должно быть строкой.',
            'FIO.max' => 'ФИО не должно превышать 255 символов.',
            'FIO.regex' => 'ФИО должно содержать только русские буквы и пробелы.',

            'phone.required' => 'Поле телефона обязательно для заполнения.',
            'phone.string' => 'Телефон должен быть строкой.',
            'phone.max' => 'Телефон не должен превышать 255 символов.',
            'phone.regex' => 'Телефон должен быть в формате +7(999)999-99-99.',

            'email.required' => 'Поле email обязательно для заполнения.',
            'email.email' => 'Введите корректный email.',
            'email.max' => 'Email не должен превышать 255 символов.',
            'email.unique' => 'Этот email уже занят.',

            'telegram_user.string' => 'Telegram должен быть строкой.',
            'telegram_user.max' => 'Telegram не должен превышать 255 символов.',
        ];
    }
}
