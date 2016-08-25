<?php

namespace App;

use App\Garena\Auth\GWSAuthenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Account extends Model implements Authenticatable
{
    use GWSAuthenticatable;
    
    protected $fillable = [
        'uid',
        'username',
        'email',
        'client_ip',
        'phone_number',
        'full_name',
        'identity_card',
        'date_of_birth',
        'address',
        'university_id'
    ];
    
    public function university()
    {
        return $this->belongsTo(University::class);
    }

}
