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
            $table->text('bio')->nullable()->after('profile_photo');
            $table->string('twitter_url')->nullable()->after('bio');
            $table->string('github_url')->nullable()->after('twitter_url');
            $table->string('linkedin_url')->nullable()->after('github_url');
            $table->string('website_url')->nullable()->after('linkedin_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['bio', 'twitter_url', 'github_url', 'linkedin_url', 'website_url']);
        });
    }
};
