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
            'price' => ['required', 'numeric', 'min:1'],
            'count_room' => ['required', 'integer', 'min:1'],
            'square' => ['required', 'numeric', 'min:1'],
            'typeOfSell' => ['required', 'in:Аренда,Продажа'],
            'district_id' => ['required', 'exists:federal_districts,id'],
            'region_id' => ['required', 'exists:regions,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'flatOrHouse' => ['required', 'in:Квартира,Дом'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'photos.required' => 'Добавьте хотя бы одну фотографию.',
            'photos.array' => 'Фотографии должны быть массивом.',
            'photos.*.image' => 'Каждый файл должен быть изображением.',
            'photos.*.mimes' => 'Фотографии должны быть в формате jpeg, jpg или png.',
            'photos.*.max' => 'Каждое изображение не должно превышать 5 МБ.',

            'price.required' => 'Пожалуйста, укажите цену.',
            'price.numeric' => 'Цена должна быть числом.',
            'price.min' => 'Цена должна быть больше нуля.',

            'count_room.required' => 'Пожалуйста, укажите количество комнат.',
            'count_room.integer' => 'Количество комнат должно быть целым числом.',
            'count_room.min' => 'Количество комнат должно быть не меньше одного.',

            'square.required' => 'Пожалуйста, укажите площадь.',
            'square.numeric' => 'Площадь должна быть числом.',
            'square.min' => 'Площадь должна быть больше нуля.',

            'typeOfSell.required' => 'Пожалуйста, выберите тип продажи.',
            'typeOfSell.in' => 'Тип продажи может быть только "Аренда" или "Продажа".',

            'district_id.required' => 'Пожалуйста, выберите федеральный округ.',
            'district_id.exists' => 'Указанный федеральный округ не существует.',

            'region_id.required' => 'Пожалуйста, выберите регион.',
            'region_id.exists' => 'Указанный регион не существует.',

            'city_id.required' => 'Пожалуйста, выберите город.',
            'city_id.exists' => 'Указанный город не существует.',

            'flatOrHouse.required' => 'Пожалуйста, выберите тип объекта.',
            'flatOrHouse.in' => 'Тип объекта может быть только "Квартира" или "Дом".',

            'description.string' => 'Описание должно быть строкой.',
            'description.max' => 'Описание не может превышать 1000 символов.',
        ];
    }
}
