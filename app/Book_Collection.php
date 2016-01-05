<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_Collection extends Model
{
    protected $table = 'books_collections';
    protected $primaryKey = 'id';
    protected $fillable = ['book_id', 'collection_id'];
}
