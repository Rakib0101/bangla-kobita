<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run seeders
        $this->call([
            CategorySeeder::class,
            PoetSeeder::class,
        ]);

        // Create a test user
        User::factory()->create([
            'name' => 'Test User',
            'name_english' => 'Test User',
            'name_bangla' => 'টেস্ট ইউজার',
            'login_name' => 'testuser',
            'email' => 'test@example.com',
            'input_method' => 'avro',
            'has_other_account' => 'no',
            'terms_accepted' => true,
            'is_active' => true,
        ]);
    }
}
