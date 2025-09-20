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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name_bangla'); // বাংলা নাম
            $table->string('name_english'); // ইংরেজি নাম
            $table->string('slug')->unique();
            $table->string('color', 7)->default('#6B7280'); // রঙ কোড
            $table->boolean('is_active')->default(true);
            $table->integer('usage_count')->default(0); // ব্যবহারের সংখ্যা
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};