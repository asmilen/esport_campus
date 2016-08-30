<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    protected $fillable = [
        'account_id',
        'email',
        'phone_number',
        'full_name',
        'identity_card',
        'score',
        'university_id'
    ];
    
    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
