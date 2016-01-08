<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id_reviewer', 'user_id', 'review', 'qualidade', 'payment_id'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
