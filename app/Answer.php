<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $fillable = [
        'question_id',
        'answer',
        'status',
    ];

    protected $dates = ['created_at', 'updated_at'];

}
