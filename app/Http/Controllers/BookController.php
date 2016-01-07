<?php

namespace App\Http\Controllers;

use App\Author;
use App\Author_Book;
use App\Book_Collection;
use App\Publisher;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Input;
use App\Book;
use Auth;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        $data = INPUT::all();
        $rules = $this->rules();
        $messages = $this->messages();
        $validator = Validator::make($data, $rules, $messages);
        if (!$validator->fails()) {
            $book = new Book;
            $book->id_user = $user_id;
            $book->title = $data['title'];
            $book->subtitle = $data['subtitle'];
            $book->publishedDate = $data['publishedDate'];
            $book->description = $data['description'];
            $book->pages = $data['pages'];
            $book->isbn10 = $data['isbn10'];
            $book->isbn13 = $data['isbn13'];
            $book->price_day = $data['price_day'];
            $book->price_bail = $data['price_bail'];
            $book->price_sale = $data['price_sale'];
            $book->language = $data['language'];
            if ($data['publisher'] != '0') {
                $book->id_publisher = $data['publisher'];
            } else {
                $publisher = new Publisher;
                $publisher->publisher = $data['newpublisher'];
                $publisher->save();
                $book->id_publisher = $publisher->id;
            }
            $book->cover = file_get_contents($data['cover']);
            $book->save();
            $book_id = $book->id;

            $book_collection = new Book_Collection;
            $book_collection->book_id = $book_id;
            $book_collection->collection_id = $data['collection'];

            $authors = explode(',', $data['authors']);
            foreach ($authors as $author) {
                $tmp = Author::where('name', 'like', $author)->limit(1)->get();
                if (count($tmp) > 0) {
                    $author_book = new Author_Book;
                    $author_book->book_id = $book_id;
                    $author_book->author_id = $tmp[0]->id;
                    $author_book->save();
                } else {
                    $newAuthor = new Author;
                    $newAuthor->name = $author;
                    $newAuthor->save();
                    $author_id = $newAuthor->id;
                    $author_book = new Author_Book;
                    $author_book->book_id = $book_id;
                    $author_book->author_id = $author_id;
                    $author_book->save();
                }
            }
            return redirect('book/show/' . $book_id . '');
        } else {
            return back()->withInput($data)->withErrors();
        }

    }

    public function remove($id)
    {
        try {
            $books = Book::where('id_user', Auth::user()->id)->where('id', $id)->get();
            foreach ($books as $book) {
                $book->active == 1 ? $book->active = 0 : $book->active = 1;
                $book->save();
            }

        } catch (\Exception $e) {
            return back();
        }
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user_id = Auth::user()->id;
        $data = INPUT::all();
        $rules = $this->rules();
        $messages = $this->messages();
        $validator = Validator::make($data, $rules, $messages);
        if (!$validator->fails()) {
            $book = Book::find($data['id']);
            $book->title = $data['title'];
            $book->subtitle = $data['subtitle'];
            $book->publishedDate = $data['publishedDate'];
            $book->description = $data['description'];
            $book->pages = $data['pages'];
            $book->isbn10 = $data['isbn10'];
            $book->isbn13 = $data['isbn13'];
            $book->price_day = $data['price_day'];
            $book->price_bail = $data['price_bail'];
            $book->price_sale = $data['price_sale'];
            $book->language = $data['language'];

            if ($data['publisher'] != $book->id_publisher) {
                if ($data['publisher'] != '0') {
                    $book->id_publisher = $data['publisher'];
                } else {
                    $publisher = new Publisher;
                    $publisher->publisher = $data['newpublisher'];
                    $publisher->save();
                    $book->id_publisher = $publisher->id;
                }
            }

            if (isset($data['cover'])) {
                $book->cover = file_get_contents($data['cover']);
            }

            $book_id = $book->id;
            Book_Collection::where('book_id', $book_id)->delete();
            Author_Book::where('book_id', $book_id)->delete();

            $book_collection = new Book_Collection;
            $book_collection->book_id = $book_id;
            $book_collection->collection_id = $data['collection'];

            $authors = explode(',', $data['authors']);
            foreach ($authors as $author) {
                $tmp = Author::where('name', 'like', $author)->limit(1)->get();
                if (count($tmp) > 0) {
                    $author_book = new Author_Book;
                    $author_book->book_id = $book_id;
                    $author_book->author_id = $tmp[0]->id;
                    $author_book->save();
                } else {
                    $newAuthor = new Author;
                    $newAuthor->name = $author;
                    $newAuthor->save();
                    $author_id = $newAuthor->id;
                    $author_book = new Author_Book;
                    $author_book->book_id = $book_id;
                    $author_book->author_id = $author_id;
                    $author_book->save();
                }
            }
            $book->save();
            return redirect('book/edit/' . $book_id . '');
        }
        return back()->withInput($data)->withErrors();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'publishedDate' => 'required|date_format:Y',
            'description' => 'required',
            'pages' => 'required|integer',
            'isbn10' => 'digits:10',
            'isbn13' => 'digits:13',
            'price_day' => 'required|between:0.0, 1000',
            'price_sale' => 'required|between:0.0, 1000',
            'price_bail' => 'required|between:0.0, 1000',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Campo "Titulo" é obrigatório',
            'publishedDate.required' => 'Campo "Data Publicação" é obrigatório',
            'description.required' => 'Campo "Descrição" é obrigatório',
            'pages.required' => 'Campo "Nº Páginas" é obrigatório',
            'isbn10.required' => 'Campo "ISBN 10" é obrigatório',
            'isbn13.required' => 'Campo "ISBN 13" é obrigatório',
            'price_day.required' => 'Campo "preço/dia" é obrigatório',
            'price_bail.required' => 'Campo "Caução" é obrigatório',
            'price_sale.required' => 'Campo "Preço venda" é obrigatório',
            'cover.required' => 'Campo "Capa" é obrigatório',
            'image' => 'Os formatos válidos são : jpeg, png, bmp, gif, e svg',
            'date_format' => 'São permitidos o seguintes formatos: AAAA-mm-dd ou AAAA'
        ];
    }
}
