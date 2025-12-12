<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'short_description', 
        'thumbnail_path', 'preview_video_url', 'price', 
        'is_published', 'is_featured', 'difficulty_level', 
        'duration_hours', 'instructor_id',
        'meta_title', 'meta_description', 'meta_keywords'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('position');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_course');
    }
}
