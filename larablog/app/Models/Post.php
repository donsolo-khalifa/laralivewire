<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }
    function scopeFeatured($query)
    {
        $query->where('featured', true);
    }
}
