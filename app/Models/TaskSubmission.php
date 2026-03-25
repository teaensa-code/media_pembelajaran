<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskSubmission extends Model
{
    protected $table = 'task_submissions';
    protected $fillable = ['task_id', 'user_id', 'file_path', 'submitted_at', 'grade', 'feedback', 'graded_at'];
    protected $casts = [
        'submitted_at' => 'datetime',
        'graded_at' => 'datetime',
    ];

    /**
     * Get the task this submission belongs to
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Get the user who submitted this task
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
