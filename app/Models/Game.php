<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    protected $fillable = ['title', 'description', 'file_path', 'link'];

    public function results(): HasMany
    {
        return $this->hasMany(GameResult::class);
    }
}
