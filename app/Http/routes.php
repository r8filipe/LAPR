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
Route::get('/cart/remove/{id}', ['middleware' => 'auth.role:1', function ($id) {
    foreach (Session::get('cart.items') as $key => $item) {
        if ($item == $id) {
            Session::forget('cart.items.' . $key);
        }
    }
    return back();
}]);

Route::get('/historico', 'HomeController@getHistorico');


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


//user
Route::get('/user/review/{user}/{payment}/{book}', ['middleware' => 'auth.role:1', function ($user, $payment, $book) {
    $user = \App\User::find($user);
    return view('user/review', ['user' => $user, 'payment' => $payment, 'book' => $book]);
}]);
Route::post("/user/review", ['middleware' => 'auth.role:1', 'uses' => 'UserController@review']);

Route::get('/user/review/{user}',['middleware' => 'auth.role:1', function($user){
    $user = \App\User::find($user);
    return view('user/reviews',['user' => $user]);
}]);
Route::get('/user/status/{user}',['middleware' => 'auth.role:4', function($user){
    $user = \App\User::find($user);
    $user->active = 0;
    $user->save();

    return back();
}]);

//test routes
Route::get('/test/addbook', 'TestController@addbooks');
Route::get('/test/sendmail', function () {

    $user = App\User::find(4);
    $content = "Os temas e estilos também contribuem para manter o seu documento coordenado. Quando clica em Estrutura e escolhe um novo Tema, as imagens, gráficos e gráficos SmartArt são alterados para que combinem com o seu novo tema. Quando aplica estilos, os seus títulos alteram-se para combinar com o novo tema.
Poupe tempo no Word com novos botões que aparecem onde precisa deles. Para alterar a forma como uma imagem se adequa ao seu documento, clique nela e aparecerá um botão para opções de esquema junto à mesma. Quando trabalha numa tabela, clique onde quiser para adicionar uma linha ou uma coluna e  clique no sinal de adição.
Ler é também mais fácil com a nova vista de Leitura<br/> Pode fechar partes do documento e concentrar-se no texto que quiser. Se precisar de parar de ler antes de chegar ao final, o Word lembra-se do local onde ficou - mesmo noutro dispositivo.
O vídeo é uma forma poderosa de provar o seu ponto de vista. Quando clica em Vídeo Online, pode colar o código incorporado para o vídeo que quer adicionar. Pode também escrever uma palavra-chave para procurar online o vídeo que melhor se adapta ao seu documento.
Para dar um ar de produção profissional<br/> ao seu documento, o Word disponibiliza desenhos de cabeçalho, rodapé, folha de rosto e caixas de texto que se complementam entre si. Por exemplo, pode adicionar uma folha de rosto, um cabeçalho e uma barra lateral que combinam entre si. Clique em Inserir e escolha os elementos que quiser das diferentes galerias.
";
    Mail::send(array('html' => 'emails.welcome'), ['user' => $user, "content" => $content], function ($m) use ($user) {
        $m->from('28124@ufp.edu.pt', 'Your Application');

        $m->to('28124@ufp.edu.pt', $user->name)->subject('Your Reminder!');
        $m->attach('images/facebook.png');
        $m->attach('images/twitter.png');
        $m->attach('images/linkedin.png');
        $m->attach('images/instagram.png');
        $m->attach('images/xbook.png');
    });
});

Route::get('/test/email', function () {
    $user = \App\User::find(4);
    $content = "Os temas e estilos também contribuem para manter o seu documento coordenado. Quando clica em Estrutura e escolhe um novo Tema, as imagens, gráficos e gráficos SmartArt são alterados para que combinem com o seu novo tema. Quando aplica estilos, os seus títulos alteram-se para combinar com o novo tema.
Poupe tempo no Word com novos botões que aparecem onde precisa deles. Para alterar a forma como uma imagem se adequa ao seu documento, clique nela e aparecerá um botão para opções de esquema junto à mesma. Quando trabalha numa tabela, clique onde quiser para adicionar uma linha ou uma coluna e  clique no sinal de adição.
Ler é também mais fácil com a nova vista de Leitura.<br/> Pode fechar partes do documento e concentrar-se no texto que quiser. Se precisar de parar de ler antes de chegar ao final, o Word lembra-se do local onde ficou - mesmo noutro dispositivo.
O vídeo é uma forma poderosa de provar o seu ponto de vista. Quando clica em Vídeo Online, pode colar o código incorporado para o vídeo que quer adicionar. Pode também escrever uma palavra-chave para procurar online o vídeo que melhor se adapta ao seu documento.
Para dar um ar de produção profissional<br/> ao seu documento, o Word disponibiliza desenhos de cabeçalho, rodapé, folha de rosto e caixas de texto que se complementam entre si. Por exemplo, pode adicionar uma folha de rosto, um cabeçalho e uma barra lateral que combinam entre si. Clique em Inserir e escolha os elementos que quiser das diferentes galerias.
";
    return view('emails.welcome', ['user' => $user, 'content' => $content]);
});

Route::get('/about', function () {
    return view('about');
});


