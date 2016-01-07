<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('search/getAuthors', 'SearchController@getAuthors');
Route::get('/', 'SearchController@getBooks')->name('home');


//HOME
Route::get('/book/create', ['middleware' => 'auth.role:1', function () {
    $publishers = ['' => ''] + \App\Publisher::lists('publisher', 'id')->all();
    $collections = ['' => ''] + \App\Collection::lists('collection', 'id')->all();
    $publishers[0] = 'Outros';
    return view('book/create', ['publishers' => $publishers, 'collections' => $collections]);
}]);

Route::get('/book/edit/{id}', ['middleware' => 'auth.role:1', function ($id) {
    $book = \App\Book::find($id);
    $publishers = ['' => ''] + \App\Publisher::lists('publisher', 'id')->all();
    $collections = ['' => ''] + \App\Collection::lists('collection', 'id')->all();
    $publishers[0] = 'Outros';
    return view('book/edit', ['book' => $book, 'publishers' => $publishers, 'collections' => $collections]);
}]);


Route::get('/book/list', ['middleware' => 'auth.role:1', function () {
    $books = App\Book::where('id_user', '=', Auth::user()->id)
        ->where('active', 1)->get();
    return view('book/list', ['books' => $books]);
}]);
Route::get('/book/return/{id}', ['middleware' => 'auth.role:1', function ($id) {
    $returns = new App\Returns;
    $returns->rental_id = $id;
    $returns->save();
    return back();
}]);
Route::get('/book/returnConfirmed/{id}', ['middleware' => 'auth.role:1', function ($id) {
    $returns = App\Returns::where('rental_id', $id)->get();
    $returns[0]->confirmed = 1;
    $returns[0]->save();
    return back();
}]);

Route::get('/book/remove/{id}', ['middleware' => 'auth.role:1', 'uses' => 'BookController@remove']);


Route::post('/book/edit', ['middleware' => 'auth.role:1', 'uses' => 'BookController@edit']);
Route::post('/book/create', 'BookController@create');

<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> master
=======
>>>>>>> master
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//paypal
Route::post('payment', array(
    'as' => 'payment',
    'uses' => 'PaypalController@postPayment',
));
// Después de realizar el pago Paypal redirecciona a esta ruta
Route::get('payment/status', array(
    'as' => 'payment.status',
    'uses' => 'PaypalController@getPaymentStatus',
));

//carrinho
Route::get('/cart/add/{product}', ['middleware' => 'auth.role:1', function ($product) {
    Session::push('cart.items', $product);
    return back();
}]);

Route::get('/cart/clear', ['middleware' => 'auth.role:1', function () {
    Session::forget('cart');
    return back();
}]);

Route::get('/cart/show', ['middleware' => 'auth.role:1', function () {
    if (Session::has('cart.items')) {
        $books = \App\Book::find(Session::get('cart.items'));
        return view('cart/show', ['books' => $books]);
    }
}]);


//Historico
Route::get('/historico', 'HomeController@getHistorico');

<<<<<<< HEAD
<<<<<<< HEAD
//backend
Route::get('/backend/', ['middleware' => 'auth.role:4', function () {
    $books = App\Book::where('active', 0)->get();
    $users = App\user::where('active', 0)->get();
    return view('admin/home', ['books' => $books, 'users' => $users]);
}]);
Route::get('/backend/books', ['middleware' => 'auth.role:4', function () {
    $books = App\Book::all();
    return view('admin/listBooks', ['books' => $books]);
}]);
Route::get('/backend/users', ['middleware' => 'auth.role:4', function () {
    $users = App\user::all();
    return view('admin/listUsers', ['users' => $users]);
}]);

Route::get('/backend/book/status/{id}', ['middleware' => 'auth.role:4', function ($id) {
    try {
        $books = App\Book::where('id', $id)->get();
        foreach ($books as $book) {
            $book->active == 1 ? $book->active = 0 : $book->active = 1;
            $book->save();
        }

    } catch (\Exception $e) {
        return back();
    }
    return back();
}]);


//test routes
Route::get('/test/addbook', 'TestController@addbooks');
Route::get('/test/sendmail', function () {

    $user = App\User::find(Auth::user()->id);

    Mail::send('emails.welcome', ['user' => $user], function ($m) use ($user) {
        $m->from('r8filipe@gmail.com', 'Your Application');

        $m->to($user->email, $user->name)->subject('Your Reminder!');
    });
});
=======

//test routes
Route::get('test/addbook', 'TestController@addbooks');
>>>>>>> master
=======

//test routes
Route::get('test/addbook', 'TestController@addbooks');
>>>>>>> master
