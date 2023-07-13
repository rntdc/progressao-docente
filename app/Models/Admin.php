<?php

namespace App\Models;

class Admin extends User
{
    public static function boot()
    {
        parent::boot();

        static::creating(function ($admin) {
            $admin->forceFill(['type' => self::class]);
        });
    }

    public static function booted()
    {
        static::addGlobalScope(static::class, function($builder) {
            $builder->where('type', static::class);
        });
    }
}
