<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubItem extends Model
{
    protected $table = 'subitems';

    protected $fillable = [
        'name',
        'index',
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'id_item');
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question', 'id_subitem')->orderBy('index');
    }

}
