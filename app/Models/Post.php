<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'seo_title',
        'seo_description',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category_id',
        'active',
        'author_name',
        'author_link',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}