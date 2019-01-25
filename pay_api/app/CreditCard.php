<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $fillable = [
        'name_card', 'number_card', 'expiration', 'ccv', 'is_valid'
    ];
}
