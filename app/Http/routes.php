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


//backend
Route::get('backend/listBooks', 'BackendController@listBooks');


//HOME
Route::get('/book/create', ['middleware' => 'auth.role:1', function () {
    $publishers = ['' => ''] + \App\Publisher::lists('publisher', 'id')->all();
    $collections = ['' => ''] + \App\Collection::lists('collection', 'id')->all();
    $publishers[0] = 'Outros';
    return view('book/create', ['publishers' => $publishers, 'collections' => $collections]);
}]);

Route::get('/book/list', ['middleware' => 'auth.role:1', function () {
    $books = App\Book::where('id_user', '=', Auth::user()->id)->get();
    return view('book/list', ['books' => $books]);
}]);

Route::get('/book/remove/{id}', ['middleware' => 'auth.role:1', 'uses' => 'BookController@remove']);

Route::post('/book/create', 'BookController@create');

//test routes
Route::get('test/addbook', 'TestController@addbooks');

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