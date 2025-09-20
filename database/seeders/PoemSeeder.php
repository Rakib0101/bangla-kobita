<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poem;
use App\Models\User;
use App\Models\Category;
use App\Models\Poet;
use App\Models\Tag;

class PoemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get users, categories, poets, and tags
        $users = User::all();
        $categories = Category::all();
        $poets = Poet::all();
        $tags = Tag::all();

        $poems = [
            [
                'title_bangla' => 'আমার সোনার বাংলা',
                'title_english' => 'My Golden Bengal',
                'slug' => 'amar-sonar-bangla',
                'content_bangla' => 'আমার সোনার বাংলা, আমি তোমায় ভালোবাসি।\nচিরদিন তোমার আকাশ, তোমার বাতাস, আমার প্রাণে বাজায় বাঁশি।',
                'content_english' => 'My golden Bengal, I love you.\nYour sky, your air forever plays the flute in my heart.',
                'user_id' => $users->where('email', 'rabindranath@example.com')->first()->id,
                'poet_id' => $poets->where('name', 'রবীন্দ্রনাথ ঠাকুর')->first()->id ?? $poets->first()->id,
                'category_id' => $categories->where('name', 'দেশপ্রেম')->first()->id ?? $categories->first()->id,
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title_bangla' => 'বিদ্রোহী',
                'title_english' => 'The Rebel',
                'slug' => 'bidrohi',
                'content_bangla' => 'বল বীর—\nবল উন্নত মম শির!\nশির নেহারি আমারি, নত-শির ওই শিখর-রবি!',
                'content_english' => 'Say, O brave one—\nSay, my head is held high!\nThis head is mine, not bowed like the setting sun!',
                'user_id' => $users->where('email', 'nazrul@example.com')->first()->id,
                'poet_id' => $poets->where('name', 'কাজী নজরুল ইসলাম')->first()->id ?? $poets->first()->id,
                'category_id' => $categories->where('name', 'দেশপ্রেম')->first()->id ?? $categories->first()->id,
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title_bangla' => 'প্রকৃতির কথা',
                'title_english' => 'Words of Nature',
                'slug' => 'prakritir-kotha',
                'content_bangla' => 'বসন্তের হাওয়া বইছে গাছে গাছে,\nনতুন পাতা গজিয়েছে সবুজ রঙে।\nপাখিরা গান গাইছে ডালে ডালে,\nপ্রকৃতি যেন হাসছে মুখে মুখে।',
                'content_english' => 'The spring breeze is blowing through the trees,\nNew leaves have sprouted in green color.\nBirds are singing on branch after branch,\nNature seems to be smiling face to face.',
                'user_id' => $users->where('email', 'sufia@example.com')->first()->id,
                'poet_id' => $poets->where('name', 'সুফিয়া কামাল')->first()->id ?? $poets->first()->id,
                'category_id' => $categories->where('name', 'প্রকৃতি')->first()->id ?? $categories->first()->id,
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title_bangla' => 'বন্ধুত্ব',
                'title_english' => 'Friendship',
                'slug' => 'bondhutto',
                'content_bangla' => 'বন্ধু তুমি আমার জীবনের আলো,\nতোমার ছাড়া জীবন অন্ধকার।\nতোমার হাসি আমার দুঃখের বালাই,\nতোমার কথা আমার প্রাণের সার।',
                'content_english' => 'Friend, you are the light of my life,\nWithout you, life is darkness.\nYour smile is the cure for my sorrow,\nYour words are the essence of my soul.',
                'user_id' => $users->where('email', 'shamsur@example.com')->first()->id,
                'poet_id' => $poets->where('name', 'শামসুর রাহমান')->first()->id ?? $poets->first()->id,
                'category_id' => $categories->where('name', 'বন্ধুত্ব')->first()->id ?? $categories->first()->id,
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title_bangla' => 'প্রেমের কবিতা',
                'title_english' => 'Love Poem',
                'slug' => 'premer-kobita',
                'content_bangla' => 'তোমার চোখে আমি দেখি আকাশের নীল,\nতোমার হাসিতে ফুটে ওঠে ফুলের মালা।\nতোমার কথা শুনে আমার মন হয় চঞ্চল,\nতোমার প্রেমে আমি হারিয়ে যাই।',
                'content_english' => 'In your eyes I see the blue of the sky,\nIn your smile blooms a garland of flowers.\nHearing your words makes my heart restless,\nIn your love I get lost.',
                'user_id' => $users->where('email', 'humayun@example.com')->first()->id,
                'poet_id' => $poets->where('name', 'হুমায়ুন আহমেদ')->first()->id ?? $poets->first()->id,
                'category_id' => $categories->where('name', 'প্রেম')->first()->id ?? $categories->first()->id,
                'is_published' => true,
                'published_at' => now(),
            ],
        ];

        foreach ($poems as $poemData) {
            $poem = Poem::create($poemData);
            
            // Attach random tags to poems
            $randomTags = $tags->random(rand(2, 4));
            $poem->tags()->attach($randomTags->pluck('id'));
        }
    }
}