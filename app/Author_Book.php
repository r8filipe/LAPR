<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author_Book extends Model
{
    protected $table = 'author_book';
    protected $primaryKey = 'id';
    protected $fillable = ['book_id', 'author_id'];
}
