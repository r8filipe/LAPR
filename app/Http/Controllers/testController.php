<?php

namespace App\Http\Controllers;

use App\Publisher;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Author;
use App\Book;
use App\Collection;
use App\Book_Collection;
use App\Author_Book;

class TestController extends Controller
{
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function addbooks()
    {
        header('Content-Type: text/html; charset=utf-8');

        for ($i = 0; $i <= 10; $i++) {
            $user = new User;
            $user->name = $this->generateRandomString(5);
            $user->password = bcrypt($user->name);
            $user->email = $user->name . '@gmail.com';
            $user->save();
        }


        $names = ['%22feliz%20gouveia%22', '%22nuno%20ribeiro%22', '%22jose%20torres%22', '%22borges%20gouveia%22',
            '%22Sophia%20breyner%22', '%22Fernando%20Pessoa%22', '%22Eça%20De%20Queiros%22'];
        foreach ($names as $name) {

            $content = file_get_contents('https://www.googleapis.com/books/v1/volumes?q=' . $name);

            $content = json_decode($content, true);
            $auts = Author::all('name');
            $authors = array();
            foreach ($auts as $aut) {
                $authors[] = $aut['name'];
            }

            $pubs = Publisher::all('publisher');
            $publishers = array();
            foreach ($pubs as $pub) {
                $publishers[] = $pub['publisher'];
            }


            $cats = Collection::all('collection');
            $categories = array();
            foreach ($cats as $cat) {
                $categories[] = $cat['collection'];
            }


            foreach ($content['items'] as $data) {
                $data = $data['volumeInfo'];
                $book = new Book;
                if (isset($data['title'])) $book->title = $data['title'];
                if (isset($data['subtitle'])) $book->subtitle = $data['subtitle'];
                if (isset($data['publishedDate'])) $book->publishedDate = $data['publishedDate'];
                if (isset($data['description'])) $book->description = $data['description'];
                if (isset($data['pageCount'])) $book->pages = $data['pageCount'];
                if (isset($data['language'])) $book->language = $data['language'];

                if (isset($data['industryIdentifiers'])) {
                    foreach ($data['industryIdentifiers'] as $value) {
                        if ($value['type'] == 'ISBN_13') $book->isbn13 = $value['identifier'];
                        if ($value['type'] == 'ISBN_10') $book->isbn10 = $value['identifier'];
                    }
                }

                if (isset($data['publisher'])) {
                    if (!(in_array($data['publisher'], $publishers))) {
                        $publishers[] = $data['publisher'];
                        $publisher = new Publisher;
                        $publisher->publisher = $data['publisher'];
                        $publisher->save();
                        $publisher_id = $publisher->id;
                    } else {
                        $publisher = Publisher::where('publisher', '=', $data['publisher'])->limit(1)->get();
                        $publisher_id = $publisher[0]->id;
                    }
                }


                if (isset($data['imageLinks']['thumbnail'])) $book->cover = file_get_contents($data['imageLinks']['thumbnail']);
                $book->price_day = random_int(0, 15);
                $book->price_bail = random_int(10, 50);
                $book->price_sale = random_int(10, 79);

                $books[] = $book;
                $book->id_publisher = $publisher_id;
                $book->id_user = rand(1,10);

                $book->save();
                $book_id = $book->id;

                if (isset($data['categories'])) {
                    foreach ($data['categories'] as $value) {
                        if (!(in_array($value, $categories))) {
                            $categories[] = $value;
                            $category = new Collection;
                            $category->collection = $value;
                            $category->save();
                            $category_id = $category->id;
                            $collections = new Book_Collection;
                            $collections->book_id = $book_id;
                            $collections->collection_id = $category_id;
                            $collections->save();
                        } else {
                            $category = Collection::where('collection', '=', $value)->limit(1)->get();
                            $collections = new Book_Collection;
                            $collections->book_id = $book_id;
                            $collections->collection_id = $category[0]->id;
                            $collections->save();
                        }
                    }
                }

                if (isset($data['authors'])) {
                    foreach ($data['authors'] as $value) {
                        if (!(in_array($value, $authors))) {
                            $authors[] = $value;
                            $author = new Author;
                            $author->name = $value;
                            $author->save();
                            $author_id = $author->id;
                            $author_book = New Author_Book;
                            $author_book->book_id = $book_id;
                            $author_book->author_id = $author_id;
                            $author_book->save();
                        } else {
                            $author = Author::where('name', 'like', $value)->limit(1)->get();
                            $author_book = New Author_Book;
                            $author_book->book_id = $book_id;
                            $author_book->author_id = $author[0]->id;
                            $author_book->save();
                        }
                    }
                }


                # code...
            }
        }
    }
}
