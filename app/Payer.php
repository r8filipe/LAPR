<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payer extends Model
{
    protected $table = 'payer';
    protected $primaryKey = 'id';

    protected $fillable = ['payer_id', 'payment_id',
        'first_name',
        'last_name',
        'line1',
        'city',
        'state',
        'postal_code',
        'country_code',
        'phone',
        'country_code',
        'email'
    ];


}
