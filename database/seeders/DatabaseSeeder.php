<?php

namespace Database\Seeders;

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
    }
}
