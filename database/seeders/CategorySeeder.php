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
            // Content Types
            [
                'name_bangla' => 'কবিতা',
                'name_english' => 'Poems',
                'slug' => 'kobita',
                'description_bangla' => 'বিভিন্ন ধরনের কবিতা',
                'description_english' => 'Various types of poems',
                'color' => '#EF4444',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name_bangla' => 'উপন্যাস',
                'name_english' => 'Novels',
                'slug' => 'uponnas',
                'description_bangla' => 'দীর্ঘ গল্প ও উপন্যাস',
                'description_english' => 'Long stories and novels',
                'color' => '#10B981',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name_bangla' => 'ছোটগল্প',
                'name_english' => 'Short Stories',
                'slug' => 'chotogolpo',
                'description_bangla' => 'ছোট ও মাঝারি গল্প',
                'description_english' => 'Short and medium stories',
                'color' => '#3B82F6',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name_bangla' => 'ব্লগ',
                'name_english' => 'Blogs',
                'slug' => 'blog',
                'description_bangla' => 'ব্যক্তিগত ব্লগ ও মতামত',
                'description_english' => 'Personal blogs and opinions',
                'color' => '#8B5CF6',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'name_bangla' => 'ছড়া',
                'name_english' => 'Rhymes',
                'slug' => 'chora',
                'description_bangla' => 'ছড়া ও শিশুতোষ রচনা',
                'description_english' => 'Rhymes and children\'s literature',
                'color' => '#F59E0B',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'name_bangla' => 'প্রবন্ধ',
                'name_english' => 'Essays',
                'slug' => 'probondho',
                'description_bangla' => 'বিশ্লেষণমূলক প্রবন্ধ',
                'description_english' => 'Analytical essays',
                'color' => '#EC4899',
                'is_active' => true,
                'sort_order' => 6
            ],
            [
                'name_bangla' => 'নাটক',
                'name_english' => 'Drama',
                'slug' => 'natok',
                'description_bangla' => 'নাটক ও নাট্য রচনা',
                'description_english' => 'Drama and theatrical works',
                'color' => '#06B6D4',
                'is_active' => true,
                'sort_order' => 7
            ],
            [
                'name_bangla' => 'অন্যান্য',
                'name_english' => 'Others',
                'slug' => 'onnyano',
                'description_bangla' => 'অন্যান্য ধরনের রচনা',
                'description_english' => 'Other types of writings',
                'color' => '#6B7280',
                'is_active' => true,
                'sort_order' => 8
            ]
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']], // lookup by unique slug
                $category                      // update or insert with this data
            );
        }
    }
}
