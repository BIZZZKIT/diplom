<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'FIO' => 'Иванов Иван Иванович',
            'email' => 'ivanov@example.com',
            'phone' => '8(999)-123-45-67',
            'password' => Hash::make('Password1!'),
            'telegram_user' => '@ivanov',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
