<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'login_name' => 'admin',
            'name' => 'Admin User',
            'name_bangla' => 'প্রশাসক',
            'name_english' => 'Admin User',
            'email' => 'admin@banglakobita.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'admin',
            'terms_accepted' => true,
            'is_poet' => false,
            'is_active' => true,
        ]);

        // Create Sample Users
        $users = [
            [
                'login_name' => 'rabindranath',
                'name' => 'Rabindranath Tagore',
                'name_bangla' => 'রবীন্দ্রনাথ ঠাকুর',
                'name_english' => 'Rabindranath Tagore',
                'email' => 'rabindranath@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'terms_accepted' => true,
                'is_poet' => true,
                'is_active' => true,
            ],
            [
                'login_name' => 'nazrul',
                'name' => 'Kazi Nazrul Islam',
                'name_bangla' => 'কাজী নজরুল ইসলাম',
                'name_english' => 'Kazi Nazrul Islam',
                'email' => 'nazrul@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'terms_accepted' => true,
                'is_poet' => true,
                'is_active' => true,
            ],
            [
                'login_name' => 'jasim',
                'name' => 'Jasim Uddin',
                'name_bangla' => 'জসীম উদ্দীন',
                'name_english' => 'Jasim Uddin',
                'email' => 'jasim@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'terms_accepted' => true,
                'is_poet' => true,
                'is_active' => true,
            ],
            [
                'login_name' => 'sufia',
                'name' => 'Sufia Kamal',
                'name_bangla' => 'সুফিয়া কামাল',
                'name_english' => 'Sufia Kamal',
                'email' => 'sufia@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'terms_accepted' => true,
                'is_poet' => true,
                'is_active' => true,
            ],
            [
                'login_name' => 'shamsur',
                'name' => 'Shamsur Rahman',
                'name_bangla' => 'শামসুর রাহমান',
                'name_english' => 'Shamsur Rahman',
                'email' => 'shamsur@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'terms_accepted' => true,
                'is_poet' => true,
                'is_active' => true,
            ],
            [
                'login_name' => 'almahmud',
                'name' => 'Al Mahmud',
                'name_bangla' => 'আল মাহমুদ',
                'name_english' => 'Al Mahmud',
                'email' => 'almahmud@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'terms_accepted' => true,
                'is_poet' => true,
                'is_active' => true,
            ],
            [
                'login_name' => 'humayun',
                'name' => 'Humayun Ahmed',
                'name_bangla' => 'হুমায়ুন আহমেদ',
                'name_english' => 'Humayun Ahmed',
                'email' => 'humayun@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'terms_accepted' => true,
                'is_poet' => true,
                'is_active' => true,
            ],
            [
                'login_name' => 'mahmudul',
                'name' => 'Mahmudul Haque',
                'name_bangla' => 'মাহমুদুল হক',
                'name_english' => 'Mahmudul Haque',
                'email' => 'mahmudul@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'terms_accepted' => true,
                'is_poet' => true,
                'is_active' => true,
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}