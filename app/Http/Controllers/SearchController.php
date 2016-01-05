<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Book;
use App\Author;

class SearchController extends Controller
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

    public function getAuthors(Request $request)
    {
        $term = $request->input('term');
        $authors = Author::where('name', 'like', '%' . $term . '%')->get();
        foreach ($authors as $author) {
            $aut[] = $author->name;
        }
        return json_encode($aut);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBooks(Request $request)
    {
        try {
            $term = $request->input();
            $url = '';
            if (count($term) > 1) {
                $books = Book::where('books.active', 1);
                if ($term['title'] != '') {
                    $books = $books->where('title', 'like', '%' . $request->input('title') . '%');
                }
                $url['title'] = $term['title'];
                if ($term['author'] != '') {
                    $books = $books->join('author_book', 'books.id', '=', 'author_book.book_id');
                    $books = $books->join('authors', 'author_book.author_id', '=', 'authors.id');
                    $books = $books->where('authors.name', 'like', '%' . $request->input('author') . '%');
                }
                $url['author'] = $term['author'];


                if ($term['collection'] != '') {
                    $books = $books->join('books_collections', 'book_id', '=', 'books.id');
                    $books = $books->where('books_collections.collection_id', '=', $request->input('collection'));
                }
                $url['collection'] = $term['collection'];

                if ($term['sort'] != '') {
                    $books = $books->orderBy('price_day', $term['sort']);
                }
                $url['sort'] = $term['sort'];

                $books = $books->select('books.*');
                $books = $books->paginate(6);


            } else {
                $books = \App\Book::where('active', '1')->paginate(6);
            }
        } catch
        (\Exception $e) {
            return back();
        } finally {
            $collections = ['' => ''] + \App\Collection::lists('collection', 'id')->all();
            return view('home', ['books' => $books, 'collections' => $collections, 'url' => $url]);
        }

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
    public function edit($id)
    {
        //
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
}
