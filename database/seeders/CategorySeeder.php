<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name_bangla' => 'প্রেমের কবিতা',
                'name_english' => 'Love Poems',
                'slug' => 'premer-kobita',
                'description_bangla' => 'প্রেম ও ভালোবাসা নিয়ে লেখা কবিতা',
                'description_english' => 'Poems about love and romance',
                'color' => '#EF4444',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name_bangla' => 'দেশপ্রেমের কবিতা',
                'name_english' => 'Patriotic Poems',
                'slug' => 'deshpremer-kobita',
                'description_bangla' => 'দেশ ও জাতি নিয়ে লেখা কবিতা',
                'description_english' => 'Poems about country and nation',
                'color' => '#10B981',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name_bangla' => 'প্রকৃতির কবিতা',
                'name_english' => 'Nature Poems',
                'slug' => 'prakritir-kobita',
                'description_bangla' => 'প্রকৃতি ও পরিবেশ নিয়ে লেখা কবিতা',
                'description_english' => 'Poems about nature and environment',
                'color' => '#3B82F6',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name_bangla' => 'ধর্মীয় কবিতা',
                'name_english' => 'Religious Poems',
                'slug' => 'dharmik-kobita',
                'description_bangla' => 'ধর্ম ও আধ্যাত্মিকতা নিয়ে লেখা কবিতা',
                'description_english' => 'Poems about religion and spirituality',
                'color' => '#8B5CF6',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'name_bangla' => 'সামাজিক কবিতা',
                'name_english' => 'Social Poems',
                'slug' => 'samajik-kobita',
                'description_bangla' => 'সমাজ ও মানুষের কথা নিয়ে লেখা কবিতা',
                'description_english' => 'Poems about society and people',
                'color' => '#F59E0B',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'name_bangla' => 'ব্যঙ্গ কবিতা',
                'name_english' => 'Satirical Poems',
                'slug' => 'byang-kobita',
                'description_bangla' => 'ব্যঙ্গ ও হাস্যরস নিয়ে লেখা কবিতা',
                'description_english' => 'Poems about satire and humor',
                'color' => '#EC4899',
                'is_active' => true,
                'sort_order' => 6
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}