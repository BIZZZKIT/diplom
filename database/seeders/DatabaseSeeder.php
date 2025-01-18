<?php

namespace Database\Seeders;

use App\Models\Cities;
use App\Models\FederalDistricts;
use App\Models\Regions;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::insert([
            [
                'FIO' => 'Иванов Иван Иванович',
                'email' => 'ivanov@example.com',
                'phone' => '8(999)-123-45-67',
                'password' => Hash::make('Password1!'),
                'telegram_user' => '@ivanov',
                'is_admin' => false,
                'is_blocked' => false,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'FIO' => 'Петров Петр Петрович',
                'email' => 'petrov@example.com',
                'phone' => '8(999)-765-43-21',
                'password' => Hash::make('Password2@'),
                'telegram_user' => '@petrov',
                'is_admin' => false,
                'is_blocked' => false,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'FIO' => 'admin',
                'email' => 'admin@example.com',
                'phone' => '8(999)-999-99-99',
                'password' => Hash::make('Administrator1!'),
                'telegram_user' => '@admin',
                'is_admin' => true,
                'is_blocked' => false,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        FederalDistricts::insert([
            ['id' => 2, 'name' => 'Центральный федеральный округ', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Южный федеральный округ', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Северо-западный федеральный округ', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Дальневосточный федеральный округ', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'Сибирский федеральный округ', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'name' => 'Уральский федеральный округ', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'name' => 'Приволжский федеральный округ', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'name' => 'Северо-Кавказский федеральный округ', 'created_at' => now(), 'updated_at' => now()]
        ]);
        Regions::insert([
            ['id' => 2, 'district_id' => 3, 'name' => 'Адыгея', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'district_id' => 6, 'name' => 'Алтай', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'district_id' => 6, 'name' => 'Алтайский край', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'district_id' => 5, 'name' => 'Амурская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'district_id' => 4, 'name' => 'Архангельская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'district_id' => 3, 'name' => 'Астраханская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'district_id' => 8, 'name' => 'Башкортостан', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'district_id' => 2, 'name' => 'Белгородская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'district_id' => 2, 'name' => 'Брянская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'district_id' => 6, 'name' => 'Бурятия', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'district_id' => 2, 'name' => 'Владимирская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'district_id' => 3, 'name' => 'Волгоградская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'district_id' => 4, 'name' => 'Вологодская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 15, 'district_id' => 2, 'name' => 'Воронежская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 16, 'district_id' => 9, 'name' => 'Дагестан', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 17, 'district_id' => 5, 'name' => 'Еврейская АО', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 18, 'district_id' => 6, 'name' => 'Забайкальский край', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 19, 'district_id' => 2, 'name' => 'Ивановская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 20, 'district_id' => 9, 'name' => 'Ингушетия', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 21, 'district_id' => 6, 'name' => 'Иркутская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 22, 'district_id' => 9, 'name' => 'Кабардино-Балкария', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 23, 'district_id' => 4, 'name' => 'Калининградская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 24, 'district_id' => 3, 'name' => 'Калмыкия', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 25, 'district_id' => 2, 'name' => 'Калужская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 26, 'district_id' => 5, 'name' => 'Камчатский край', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 27, 'district_id' => 9, 'name' => 'Карачаево-Черкессия', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 28, 'district_id' => 4, 'name' => 'Карелия', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 29, 'district_id' => 6, 'name' => 'Кемеровская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 30, 'district_id' => 8, 'name' => 'Кировская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 31, 'district_id' => 4, 'name' => 'Коми', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 32, 'district_id' => 2, 'name' => 'Костромская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 33, 'district_id' => 3, 'name' => 'Краснодарский край', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 34, 'district_id' => 6, 'name' => 'Красноярский край', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 35, 'district_id' => 7, 'name' => 'Курганская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 36, 'district_id' => 2, 'name' => 'Курская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 37, 'district_id' => 4, 'name' => 'Ленинградская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 38, 'district_id' => 2, 'name' => 'Липецкая область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 39, 'district_id' => 5, 'name' => 'Магаданская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 40, 'district_id' => 8, 'name' => 'Марий Эл', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 41, 'district_id' => 8, 'name' => 'Мордовия', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 42, 'district_id' => 2, 'name' => 'Москва', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 43, 'district_id' => 2, 'name' => 'Московская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 44, 'district_id' => 4, 'name' => 'Мурманская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 45, 'district_id' => 4, 'name' => 'Ненецкий АО', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 46, 'district_id' => 8, 'name' => 'Нижегородская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 47, 'district_id' => 4, 'name' => 'Новгородская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 48, 'district_id' => 6, 'name' => 'Новосибирская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 49, 'district_id' => 6, 'name' => 'Омская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 50, 'district_id' => 8, 'name' => 'Оренбургская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 51, 'district_id' => 2, 'name' => 'Орловская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 52, 'district_id' => 8, 'name' => 'Пензенская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 53, 'district_id' => 8, 'name' => 'Пермский край', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 54, 'district_id' => 5, 'name' => 'Приморский край', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 55, 'district_id' => 4, 'name' => 'Псковская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 56, 'district_id' => 3, 'name' => 'Ростовская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 57, 'district_id' => 2, 'name' => 'Рязанская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 58, 'district_id' => 8, 'name' => 'Самарская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 59, 'district_id' => 4, 'name' => 'Санкт-Петербург', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 60, 'district_id' => 8, 'name' => 'Саратовская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 61, 'district_id' => 5, 'name' => 'Саха (Якутия)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 62, 'district_id' => 5, 'name' => 'Сахалинская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 63, 'district_id' => 7, 'name' => 'Свердловская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 64, 'district_id' => 9, 'name' => 'Северная Осетия - Алания', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 65, 'district_id' => 2, 'name' => 'Смоленская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 66, 'district_id' => 9, 'name' => 'Ставропольский край', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 67, 'district_id' => 2, 'name' => 'Тамбовская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 68, 'district_id' => 8, 'name' => 'Татарстан', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 69, 'district_id' => 2, 'name' => 'Тверская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 70, 'district_id' => 6, 'name' => 'Томская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 71, 'district_id' => 2, 'name' => 'Тульская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 72, 'district_id' => 6, 'name' => 'Тыва', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 73, 'district_id' => 7, 'name' => 'Тюменская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 74, 'district_id' => 8, 'name' => 'Удмуртия', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 75, 'district_id' => 8, 'name' => 'Ульяновская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 76, 'district_id' => 5, 'name' => 'Хабаровский край', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 77, 'district_id' => 6, 'name' => 'Хакасия', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 78, 'district_id' => 7, 'name' => 'Ханты-Мансийский АО - Югра', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 79, 'district_id' => 7, 'name' => 'Челябинская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 80, 'district_id' => 9, 'name' => 'Чеченская республика', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 81, 'district_id' => 8, 'name' => 'Чувашская республика', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 82, 'district_id' => 5, 'name' => 'Чукотский АО', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 83, 'district_id' => 7, 'name' => 'Ямало-Ненецкий АО', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 84, 'district_id' => 2, 'name' => 'Ярославская область', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 86, 'district_id' => 3, 'name' => 'Крым', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 87, 'district_id' => 3, 'name' => 'Севастополь', 'created_at' => now(), 'updated_at' => now()]
        ]);
        Cities::insert([

        ]);
    }
}
