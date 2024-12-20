<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePremiseRequest extends FormRequest
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
            'photos' => 'required|array',
            'photos.*' => 'image|mimes:jpeg,jpg,png|max:5120',
            'price' => ['required', 'numeric'],
            'count_room' => ['required', 'integer'],
            'square' => ['required', 'numeric'],
            'address' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'price.required' => 'Пожалуйста, укажите цену.',
            'price.numeric' => 'Цена должна быть числом.',
            'price.min' => 'Цена должна быть больше нуля.',
            'count_room.required' => 'Пожалуйста, укажите количество комнат.',
            'count_room.integer' => 'Количество комнат должно быть целым числом.',
            'count_room.min' => 'Количество комнат должно быть не меньше одного.',
            'square.required' => 'Пожалуйста, укажите площадь.',
            'square.numeric' => 'Площадь должна быть числом.',
            'square.min' => 'Площадь должна быть больше нуля.',
            'address.required' => 'Пожалуйста, укажите адрес.',
            'address.string' => 'Адрес должен быть строкой.',
            'address.max' => 'Адрес не может превышать 255 символов.',
            'description.string' => 'Описание должно быть строкой.',
            'description.max' => 'Описание не может превышать 1000 символов.',
        ];
    }
}
