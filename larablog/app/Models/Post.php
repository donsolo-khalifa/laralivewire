<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'published_at' => 'datetime',
    ];

    function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }
    function scopeFeatured($query)
    {
        $query->where('featured', true);
    }

    function getExcerpt()
    {
        return Str::limit(strip_tags($this->content), 150);
    }

    function getReadingTime()
    {
        $mins = round(str_word_count($this->content) / 250);
        return ($mins < 1) ? 1  : $mins;
    }
}
