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
        Schema::table('users', function (Blueprint $table) {
            $table->string('login_name')->unique()->after('id'); // লগইন নাম
            $table->string('name_bangla')->after('name'); // বাংলা নাম
            $table->enum('input_method', ['english', 'avro', 'unijoy'])->default('avro')->after('name_bangla'); // ইনপুট পদ্ধতি
            $table->string('name_english')->after('input_method'); // ইংরেজি নাম
            $table->enum('has_other_account', ['yes', 'no', 'inactive'])->default('no')->after('name_english'); // অন্য একাউন্ট আছে কিনা
            $table->boolean('terms_accepted')->default(false)->after('has_other_account'); // শর্তাবলী গ্রহণ
            $table->text('bio_bangla')->nullable()->after('terms_accepted'); // বাংলা বায়ো
            $table->text('bio_english')->nullable()->after('bio_bangla'); // ইংরেজি বায়ো
            $table->string('avatar')->nullable()->after('bio_english'); // প্রোফাইল ছবি
            $table->boolean('is_poet')->default(false)->after('avatar'); // কবি কিনা
            $table->boolean('is_active')->default(true)->after('is_poet'); // সক্রিয় কিনা
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'login_name',
                'name_bangla', 
                'input_method',
                'name_english',
                'has_other_account',
                'terms_accepted',
                'bio_bangla',
                'bio_english',
                'avatar',
                'is_poet',
                'is_active'
            ]);
        });
    }
};