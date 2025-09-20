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
        Schema::create('poets', function (Blueprint $table) {
            $table->id();
            $table->string('name_bangla'); // বাংলা নাম
            $table->string('name_english'); // ইংরেজি নাম
            $table->string('slug')->unique();
            $table->text('biography_bangla')->nullable(); // বাংলা জীবনী
            $table->text('biography_english')->nullable(); // ইংরেজি জীবনী
            $table->date('birth_date')->nullable(); // জন্ম তারিখ
            $table->date('death_date')->nullable(); // মৃত্যু তারিখ
            $table->string('birth_place')->nullable(); // জন্মস্থান
            $table->string('image')->nullable(); // ছবি
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false); // বিশেষ কবি
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poets');
    }
};