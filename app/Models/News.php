<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $fillable = [
        'title',
        'meta_title',
        'meta_description',
        'description',
        'image',
        'image_alt',
        'featured_image',
        'news_slug',
    ];

    protected $casts = [
        'category_id' => 'array', 
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_news', 'news_id', 'category_id');
    }
}
