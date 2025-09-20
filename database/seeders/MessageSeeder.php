<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\User;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        
        if ($users->count() < 2) {
            $this->command->info('Need at least 2 users to create messages. Please run UserSeeder first.');
            return;
        }

        $sampleMessages = [
            [
                'message_bangla' => 'আসসালামু আলাইকুম সবাই! কবিতার আসরে আপনাদের স্বাগতম।',
                'message_english' => 'Assalamu Alaikum everyone! Welcome to our poetry gathering.'
            ],
            [
                'message_bangla' => 'আজকে কি কেউ নতুন কবিতা লিখেছেন?',
                'message_english' => 'Has anyone written a new poem today?'
            ],
            [
                'message_bangla' => 'রবীন্দ্রনাথের কবিতা সবসময়ই আমার প্রিয়।',
                'message_english' => 'Rabindranath\'s poems are always my favorite.'
            ],
            [
                'message_bangla' => 'কবিতা লিখতে হলে মনকে শান্ত করতে হয়।',
                'message_english' => 'To write poetry, one needs to calm the mind.'
            ],
            [
                'message_bangla' => 'আজকে প্রকৃতির সৌন্দর্য দেখে মনটা খুব ভালো লাগছে।',
                'message_english' => 'Today, seeing the beauty of nature makes me feel very good.'
            ],
            [
                'message_bangla' => 'কবিতা হলো হৃদয়ের ভাষা।',
                'message_english' => 'Poetry is the language of the heart.'
            ],
            [
                'message_bangla' => 'সবাইকে ধন্যবাদ এই সুন্দর প্ল্যাটফর্মের জন্য।',
                'message_english' => 'Thank you everyone for this beautiful platform.'
            ],
            [
                'message_bangla' => 'আমি নতুন কবিতা লিখেছি, সবাই পড়ে দেখুন।',
                'message_english' => 'I have written a new poem, everyone please read it.'
            ]
        ];

        foreach ($sampleMessages as $index => $messageData) {
            Message::create([
                'user_id' => $users->random()->id,
                'message_bangla' => $messageData['message_bangla'],
                'message_english' => $messageData['message_english'],
                'message_type' => 'text',
                'created_at' => now()->subHours(rand(1, 24)),
                'updated_at' => now()->subHours(rand(1, 24)),
            ]);
        }

        $this->command->info('Sample messages created successfully!');
    }
}
