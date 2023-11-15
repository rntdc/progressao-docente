<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enviroment extends Model
{
    protected $table = 'env_progression';

    protected $fillable = [
        'reitor_name',
        'cppd_president',
        'cppd_secretary'
    ];
}
