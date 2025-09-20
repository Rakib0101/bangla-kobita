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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_bangla'); // বাংলা নাম
            $table->string('name_english'); // ইংরেজি নাম
            $table->string('slug')->unique();
            $table->text('description_bangla')->nullable(); // বাংলা বর্ণনা
            $table->text('description_english')->nullable(); // ইংরেজি বর্ণনা
            $table->string('color', 7)->default('#3B82F6'); // রঙ কোড
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};