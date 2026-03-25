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
        // Add file_path and video_link to videos table if not exists
        if (!Schema::hasColumn('videos', 'file_path')) {
            Schema::table('videos', function (Blueprint $table) {
                $table->string('file_path')->nullable();
            });
        }

        if (!Schema::hasColumn('videos', 'video_link')) {
            Schema::table('videos', function (Blueprint $table) {
                $table->string('video_link')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('videos', 'video_link')) {
            Schema::table('videos', function (Blueprint $table) {
                $table->dropColumn('video_link');
            });
        }

        if (Schema::hasColumn('videos', 'file_path')) {
            Schema::table('videos', function (Blueprint $table) {
                $table->dropColumn('file_path');
            });
        }
    }
};
