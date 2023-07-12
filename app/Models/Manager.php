<?php

namespace App\Models;

class Manager extends User
{
    public static function booted()
    {
        static::addGlobalScope(static::class, function($builder) {
            $builder->where('type', static::class);
        });
    }
}
