<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldCoordinator extends Model
{
    use HasFactory;
    protected $table = 'field_coordinator';
    protected $fillable = [
        'name',
        'image',
        'description',
        'designation'
    ];
}
