<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
        'class',
        'form',
        'situation',
        'siape',
        'entry_date',
        'last_progression_date',
        'is_verified',
    ];

}
