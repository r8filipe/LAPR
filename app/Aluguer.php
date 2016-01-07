<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluguer extends Model
{

    protected $table = 'aluguer';
    protected $primaryKey = 'id';
    protected $fillable = ['book_id', 'user_id', 'payment_id'];

    public function payment()
    {
        return $this->hasOne('App\Payment', 'id', 'payment_id');
    }

    public function book()
    {
        return $this->hasOne('App\Book', 'id', 'book_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function transaction()
    {
        return $this->hasMany('App\Transaction', 'payment_id', 'payment_id');
    }

    public function returns()
    {
        return $this->hasOne('App\Returns', 'rental_id', 'id');
    }

}
