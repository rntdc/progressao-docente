<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Professor extends User
{
    use AuthenticatableTrait;
    use HasFactory;

    protected $fillable = [
        'level',
        'class',
        'form',
        'situation',
        'siape',
        'entry_date',
        'last_progression_date',
        'is_verified',
    ];

    public static function booted()
    {
        static::addGlobalScope(static::class, function($builder) {
            $builder->where('type', static::class);
        });
    }

}
