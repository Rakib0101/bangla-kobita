<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name_bangla' => 'প্রেম', 'name_english' => 'Love', 'slug' => 'prem', 'color' => '#EF4444'],
            ['name_bangla' => 'প্রকৃতি', 'name_english' => 'Nature', 'slug' => 'prakriti', 'color' => '#10B981'],
            ['name_bangla' => 'জীবন', 'name_english' => 'Life', 'slug' => 'jibon', 'color' => '#3B82F6'],
            ['name_bangla' => 'দেশপ্রেম', 'name_english' => 'Patriotism', 'slug' => 'deshprem', 'color' => '#F59E0B'],
            ['name_bangla' => 'মাতৃভূমি', 'name_english' => 'Motherland', 'slug' => 'matribhumi', 'color' => '#8B5CF6'],
            ['name_bangla' => 'বন্ধুত্ব', 'name_english' => 'Friendship', 'slug' => 'bondhutto', 'color' => '#06B6D4'],
            ['name_bangla' => 'দুঃখ', 'name_english' => 'Sorrow', 'slug' => 'dukkho', 'color' => '#6B7280'],
            ['name_bangla' => 'আনন্দ', 'name_english' => 'Joy', 'slug' => 'anondo', 'color' => '#F97316'],
            ['name_bangla' => 'বিচ্ছেদ', 'name_english' => 'Separation', 'slug' => 'bicched', 'color' => '#DC2626'],
            ['name_bangla' => 'মিলন', 'name_english' => 'Union', 'slug' => 'milon', 'color' => '#059669'],
            ['name_bangla' => 'স্বপ্ন', 'name_english' => 'Dream', 'slug' => 'shopno', 'color' => '#7C3AED'],
            ['name_bangla' => 'বাস্তবতা', 'name_english' => 'Reality', 'slug' => 'bastobota', 'color' => '#374151'],
            ['name_bangla' => 'সময়', 'name_english' => 'Time', 'slug' => 'somoy', 'color' => '#1F2937'],
            ['name_bangla' => 'স্মৃতি', 'name_english' => 'Memory', 'slug' => 'smriti', 'color' => '#BE185D'],
            ['name_bangla' => 'ভবিষ্যৎ', 'name_english' => 'Future', 'slug' => 'bhabishyat', 'color' => '#0D9488'],
            ['name_bangla' => 'শৈশব', 'name_english' => 'Childhood', 'slug' => 'shoishob', 'color' => '#F59E0B'],
            ['name_bangla' => 'যৌবন', 'name_english' => 'Youth', 'slug' => 'joubun', 'color' => '#EC4899'],
            ['name_bangla' => 'বৃদ্ধাবস্থা', 'name_english' => 'Old Age', 'slug' => 'briddhabostha', 'color' => '#6B7280'],
            ['name_bangla' => 'মৃত্যু', 'name_english' => 'Death', 'slug' => 'mrittu', 'color' => '#374151'],
            ['name_bangla' => 'জন্ম', 'name_english' => 'Birth', 'slug' => 'jonmo', 'color' => '#10B981'],
            ['name_bangla' => 'ঈশ্বর', 'name_english' => 'God', 'slug' => 'ishwar', 'color' => '#8B5CF6'],
            ['name_bangla' => 'ধর্ম', 'name_english' => 'Religion', 'slug' => 'dhormo', 'color' => '#F59E0B'],
            ['name_bangla' => 'মানবতা', 'name_english' => 'Humanity', 'slug' => 'manobota', 'color' => '#3B82F6'],
            ['name_bangla' => 'সাম্য', 'name_english' => 'Equality', 'slug' => 'shammyo', 'color' => '#059669'],
            ['name_bangla' => 'স্বাধীনতা', 'name_english' => 'Freedom', 'slug' => 'shadhinota', 'color' => '#DC2626'],
        ];

        foreach ($tags as $tagData) {
            Tag::create($tagData);
        }
    }
}