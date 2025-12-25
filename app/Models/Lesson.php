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
        'is_free', 'is_published',
        'pdf_path', 'video_path'
    ];

    protected $casts = [
        'is_free' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function progress()
    {
        return $this->hasMany(LessonProgress::class);
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }
}
