<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('poems', function (Blueprint $table) {
            $table->id();
            $table->string('title_bangla'); // বাংলা শিরোনাম
            $table->string('title_english')->nullable(); // ইংরেজি শিরোনাম
            $table->string('slug')->unique();
            $table->longText('content_bangla'); // বাংলা কবিতা
            $table->longText('content_english')->nullable(); // ইংরেজি অনুবাদ
            $table->text('summary_bangla')->nullable(); // বাংলা সারসংক্ষেপ
            $table->text('summary_english')->nullable(); // ইংরেজি সারসংক্ষেপ
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // লেখক
            $table->foreignId('poet_id')->nullable()->constrained()->onDelete('set null'); // মূল কবি (যদি অনুবাদ হয়)
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // বিভাগ
            $table->boolean('is_published')->default(false); // প্রকাশিত
            $table->boolean('is_featured')->default(false); // বিশেষ কবিতা
            $table->boolean('is_translation')->default(false); // অনুবাদ
            $table->string('original_language')->default('bangla'); // মূল ভাষা
            $table->integer('views')->default(0); // দেখা হয়েছে
            $table->integer('likes')->default(0); // পছন্দ
            $table->integer('sort_order')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poems');
    }
};