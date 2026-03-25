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
        // Add file_path and link to quizzes table
        if (!Schema::hasColumn('quizzes', 'file_path')) {
            Schema::table('quizzes', function (Blueprint $table) {
                $table->string('file_path')->nullable()->after('description');
                $table->string('link')->nullable()->after('file_path');
            });
        }

        // Add file_path and link to games table
        if (!Schema::hasColumn('games', 'file_path')) {
            Schema::table('games', function (Blueprint $table) {
                $table->string('file_path')->nullable()->after('description');
                $table->string('link')->nullable()->after('file_path');
            });
        }

        // Create quiz_results table
        if (!Schema::hasTable('quiz_results')) {
            Schema::create('quiz_results', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('quiz_id');
                $table->unsignedBigInteger('user_id');
                $table->integer('score')->default(0);
                $table->text('result')->nullable();
                $table->timestamp('submitted_at')->nullable();
                $table->timestamps();

                $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->unique(['quiz_id', 'user_id']);
            });
        }

        // Create game_results table
        if (!Schema::hasTable('game_results')) {
            Schema::create('game_results', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('game_id');
                $table->unsignedBigInteger('user_id');
                $table->integer('score')->default(0);
                $table->text('result')->nullable();
                $table->timestamp('submitted_at')->nullable();
                $table->timestamps();

                $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->unique(['game_id', 'user_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_results');
        Schema::dropIfExists('game_results');

        Schema::table('quizzes', function (Blueprint $table) {
            if (Schema::hasColumn('quizzes', 'file_path')) {
                $table->dropColumn('file_path');
            }
            if (Schema::hasColumn('quizzes', 'link')) {
                $table->dropColumn('link');
            }
        });

        Schema::table('games', function (Blueprint $table) {
            if (Schema::hasColumn('games', 'file_path')) {
                $table->dropColumn('file_path');
            }
            if (Schema::hasColumn('games', 'link')) {
                $table->dropColumn('link');
            }
        });
    }
};
