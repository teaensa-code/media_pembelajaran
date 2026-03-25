<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    protected $table = 'quizzes';
    protected $fillable = ['title', 'description', 'file_path', 'link'];

    public function results(): HasMany
    {
        return $this->hasMany(QuizResult::class);
    }
}
