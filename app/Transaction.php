<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id';

    protected $fillable = ['payment_id',
        'book_id',
        'name',
        'price',
        'currency',
        'quantity',
        'description'
    ];

    public function book()
    {
        return $this->hasOne('App\Book', 'id', 'book_id');
    }
}
