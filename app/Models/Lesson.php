<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 'title', 'slug', 'video_url', 
        'video_duration', 'description', 'position', 
        'is_free', 'is_published'
    ];

    protected $casts = [
        'is_free' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
