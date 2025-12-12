<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'page', 'meta_title', 'meta_description', 'meta_keywords',
        'og_title', 'og_description', 'og_image',
        'twitter_card', 'canonical_url', 'robots'
    ];
}
