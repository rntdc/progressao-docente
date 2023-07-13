<?php

namespace App\Models;

class Professor extends User
{
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
