<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'aluguer';
    protected $primaryKey = 'id';
    protected $fillable = ['aluguer_id', 'user_id', 'review', 'qualidade'];
}
