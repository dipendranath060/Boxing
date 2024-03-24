<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalTeam extends Model
{
    use HasFactory;
    protected $table = 'medical_team';
    protected $fillable = [
        'name',
        'image',
        'description',
        'designation'
    ];
}
