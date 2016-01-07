<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    protected $table = 'returns';
    protected $primaryKey = 'id';
    protected $fillable = ['confirmed', 'rental_id', 'created_at', 'updated_at'];

    public function aluguer()
    {
        return $this->hasOne('App\Aluguer', 'id', 'rental_id');
    }

}
