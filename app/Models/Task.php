<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = ['title', 'description', 'file_path'];

    /**
     * Get submissions for this task
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(TaskSubmission::class);
    }
}
