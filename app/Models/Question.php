<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'name',
        'index',
        'pontuation',
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'id_item');
    }

    public function subitem()
    {
        return $this->belongsTo('App\Models\SubItem', 'id_subitem');
    }

}
