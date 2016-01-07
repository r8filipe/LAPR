<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

    protected $table = 'purchases';
    protected $primaryKey = 'id';
    protected $fillable = ['start', 'end', 'book_id', 'user_id', 'payment_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
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
}
