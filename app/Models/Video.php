<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'description', 'file_path', 'video_link'];

    /**
     * Get embed link for YouTube videos
     */
    public function getEmbedLinkAttribute()
    {
        if (!$this->video_link) {
            return null;
        }

        // Extract YouTube video ID from various URL formats
        if (preg_match('/(youtu\.be|youtube\.com).*[?&]v=([^&]*)/i', $this->video_link, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[2];
        }

        // Already in embed format
        if (strpos($this->video_link, 'youtube.com/embed/') !== false) {
            return $this->video_link;
        }

        // Try to extract from youtu.be format
        if (preg_match('/youtu\.be\/([^?&]*)/i', $this->video_link, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return null;
    }

    /**
     * Check if video is file-based
     */
    public function isFileVideo(): bool
    {
        return !empty($this->file_path);
    }

    /**
     * Check if video is link-based
     */
    public function isLinkVideo(): bool
    {
        return !empty($this->video_link);
    }
}
