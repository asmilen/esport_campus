<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    //
    protected $fillable = [
        'name',
        'short_name',
        'desc',
        'image',
        'status'
    ];

    protected $dates = ['created_at', 'updated_at'];

}
