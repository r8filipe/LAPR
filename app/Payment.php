<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $table = 'payment';
    protected $primaryKey = 'payment_id';
    protected $fillable = ['state', 'intent', 'cart', 'user_id'];


    public function payer()
    {
        return $this->hasOne('App\Payer', 'payment_id', 'payment_id');
    }

    public function transaction()
    {
        return $this->hasMany('App\Transaction', 'payment_id', 'payment_id');
    }
}
