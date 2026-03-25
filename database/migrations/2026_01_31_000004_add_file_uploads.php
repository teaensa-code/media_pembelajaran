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
        // Add file_path to materials table if not exists
        if (!Schema::hasColumn('materials', 'file_path')) {
            Schema::table('materials', function (Blueprint $table) {
                $table->string('file_path')->nullable();
            });
        }

        // Add file_path to tasks table if not exists
        if (!Schema::hasColumn('tasks', 'file_path')) {
            Schema::table('tasks', function (Blueprint $table) {
                $table->string('file_path')->nullable();
            });
        }

        // Create task_submissions table
        if (!Schema::hasTable('task_submissions')) {
            Schema::create('task_submissions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('task_id');
                $table->unsignedBigInteger('user_id');
                $table->string('file_path')->nullable();
                $table->timestamp('submitted_at')->nullable();
                $table->integer('grade')->nullable();
                $table->text('feedback')->nullable();
                $table->timestamp('graded_at')->nullable();
                $table->timestamps();

                $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->unique(['task_id', 'user_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_submissions');

        if (Schema::hasColumn('tasks', 'file_path')) {
            Schema::table('tasks', function (Blueprint $table) {
                $table->dropColumn('file_path');
            });
        }

        if (Schema::hasColumn('materials', 'file_path')) {
            Schema::table('materials', function (Blueprint $table) {
                $table->dropColumn('file_path');
            });
        }
    }
};
