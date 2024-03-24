<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'is_active'
    ];

    public function news()
    {
        return $this->belongsToMany(News::class, 'category_news', 'category_id', 'news_id');
    }
}
