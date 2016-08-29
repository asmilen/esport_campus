<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = [
        'question',
        'type',
        'level',
        'category',
    ];

    protected $dates = ['created_at', 'updated_at'];

}
