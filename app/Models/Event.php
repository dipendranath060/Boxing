<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = [
        'title',
        'meta_title',
        'image',
        'meta_description',
        'description',
        'venue',
        'start_date',
        'expiry_date',
        'event_slug',
    ];
}
