<?php

namespace Database\Seeders;

use App\Models\Poet;
use Illuminate\Database\Seeder;

class PoetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $poets = [
            [
                'name_bangla' => 'রবীন্দ্রনাথ ঠাকুর',
                'name_english' => 'Rabindranath Tagore',
                'slug' => 'rabindranath-thakur',
                'biography_bangla' => 'বিশ্বকবি রবীন্দ্রনাথ ঠাকুর বাংলা সাহিত্যের সবচেয়ে উজ্জ্বল নক্ষত্র। তিনি কবি, ঔপন্যাসিক, নাট্যকার, গীতিকার, সুরকার, চিত্রশিল্পী এবং দার্শনিক ছিলেন।',
                'biography_english' => 'Rabindranath Tagore was a Bengali polymath who reshaped Bengali literature and music. He was the first non-European to win the Nobel Prize in Literature in 1913.',
                'birth_date' => '1861-05-07',
                'death_date' => '1941-08-07',
                'birth_place' => 'কলকাতা, ভারত',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 1
            ],
            [
                'name_bangla' => 'কাজী নজরুল ইসলাম',
                'name_english' => 'Kazi Nazrul Islam',
                'slug' => 'kazi-nazrul-islam',
                'biography_bangla' => 'বিদ্রোহী কবি কাজী নজরুল ইসলাম বাংলা সাহিত্যের অন্যতম শ্রেষ্ঠ কবি। তিনি ছিলেন কবি, গীতিকার, সুরকার, নাট্যকার এবং সাংবাদিক।',
                'biography_english' => 'Kazi Nazrul Islam was a Bengali poet, writer, musician, and the national poet of Bangladesh. He is known as the "Rebel Poet" for his revolutionary writings.',
                'birth_date' => '1899-05-24',
                'death_date' => '1976-08-29',
                'birth_place' => 'চুরুলিয়া, পশ্চিমবঙ্গ',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 2
            ],
            [
                'name_bangla' => 'জসীম উদ্দীন',
                'name_english' => 'Jasim Uddin',
                'slug' => 'jasim-uddin',
                'biography_bangla' => 'পল্লী কবি জসীম উদ্দীন বাংলা সাহিত্যের একজন বিশিষ্ট কবি। তিনি গ্রামীণ জীবনের কথা তার কবিতায় তুলে ধরেছেন।',
                'biography_english' => 'Jasim Uddin was a Bengali poet, writer, and folklorist. He is known as the "Palli Kabi" (Rural Poet) for his poems about rural life.',
                'birth_date' => '1903-01-01',
                'death_date' => '1976-03-14',
                'birth_place' => 'তাম্বুলখানা, ফরিদপুর',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 3
            ],
            [
                'name_bangla' => 'সুকান্ত ভট্টাচার্য',
                'name_english' => 'Sukanta Bhattacharya',
                'slug' => 'sukanta-bhattacharya',
                'biography_bangla' => 'সুকান্ত ভট্টাচার্য ছিলেন একজন বাঙালি কবি। তিনি কমিউনিস্ট আদর্শে বিশ্বাসী ছিলেন এবং তার কবিতায় শ্রমজীবী মানুষের কথা বলেছেন।',
                'biography_english' => 'Sukanta Bhattacharya was a Bengali poet and playwright. He was a communist and his poems often dealt with the struggles of the working class.',
                'birth_date' => '1926-08-15',
                'death_date' => '1947-05-13',
                'birth_place' => 'কলকাতা, ভারত',
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 4
            ],
            [
                'name_bangla' => 'শামসুর রাহমান',
                'name_english' => 'Shamsur Rahman',
                'slug' => 'shamsur-rahman',
                'biography_bangla' => 'শামসুর রাহমান ছিলেন একজন বিশিষ্ট বাংলাদেশি কবি, সাংবাদিক এবং সাহিত্যিক। তিনি আধুনিক বাংলা কবিতার একজন প্রধান কবি।',
                'biography_english' => 'Shamsur Rahman was a Bangladeshi poet, columnist, and journalist. He is considered one of the greatest Bengali poets of the 20th century.',
                'birth_date' => '1929-10-23',
                'death_date' => '2006-08-17',
                'birth_place' => 'ঢাকা, বাংলাদেশ',
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 5
            ]
        ];

        foreach ($poets as $poet) {
            Poet::create($poet);
        }
    }
}