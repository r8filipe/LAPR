<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $fillable = ['title',
        'subtitle',
        'publishedDate',
        'description',
        'pages',
        'language',
        'isbn10',
        'isbn13',
        'cover',
        'price_day',
        'price_bail',
        'price_sale',
        'id_publisher',
        'id_user',
    ];

    public function publisher()
    {
        return $this->hasOne('App\Publisher', 'id', 'id_publisher');
    }

    public function authors()
    {
        return $this->belongsToMany('App\Author', 'Author_Book', 'book_id', 'author_id');
    }

    public function collections()
    {
        return $this->belongsToMany('App\Collection', 'books_collections', 'book_id', 'collection_id');

    }
}
