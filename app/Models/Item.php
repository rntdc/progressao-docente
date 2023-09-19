<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'has_subitem',
        'index',
    ];

    public function subitems()
    {
        return $this->hasMany('App\Models\SubItem', 'id_item')->orderBy('index');
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question', 'id_item')->orderBy('index');
    }

    public function getIndex()
    {
        // count all items and return the value
    }

}
