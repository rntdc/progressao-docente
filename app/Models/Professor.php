<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Professor extends Model
{
    use AuthenticatableTrait;
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
