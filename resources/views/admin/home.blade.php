@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">HOME</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Livros</div>
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover"
                               id="dataTables-listBook">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titlo</th>
                                <th>Data Publicação</th>
                                <th>Páginas</th>
                                <th>Linguagem</th>
                                <th>ISBN-10</th>
                                <th>ISBN-13</th>
                                <th>Authores</th>
                                <th>Categorias</th>
                                <th>Preço Dia</th>
                                <th>Preço Venda</th>
                                <th>Valor caução</th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <td>{{$book->id}}</td>
                                    <td>{{$book->title}} - {{$book->subtitle}}</td>
                                    <td>{{$book->publishedDate}}</td>
                                    <td>{{$book->pages}}</td>
                                    <td>{{$book->language}} </td>
                                    <td>{{$book->isbn10}}</td>
                                    <td>{{$book->isbn13}}</td>
                                    <td>
                                        @foreach($book->authors as $author)
                                            {{$author->name}} |
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($book->collections as $collection)
                                            {{$collection->collection}} |
                                        @endforeach
                                    </td>
                                    <td>{{$book->price_day}}</td>
                                    <td>{{$book->price_sale}}</td>
                                    <td>{{$book->price_bail}}</td>
                                    <td class="text-center">
                                        <a href="/backend/book/status/{{$book->id}}"><i class="fa
                                          {{$book->active == 1 ? 'fa-times' : 'fa-check'}}
                                                    fa-fw"></i></a>

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Utilizadores</div>
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover"
                               id="dataTables-listUser">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td class="text-center">
                                        <a href="/user/status/{{$user->id}}/"><i class="fa
                                          {{$user->active == 1 ? 'fa-times' : 'fa-check'}}
                                                    fa-fw"></i></a>

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

@stop