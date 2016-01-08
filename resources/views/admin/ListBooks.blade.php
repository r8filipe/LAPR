@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Livros</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Livros
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-listBook">
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
                                    <td>
                                        <a href="/backend/book/status/{{$book->id}}"><i class="fa
                                          {{$book->active == 1 ? 'fa-times' : 'fa-check'}}
                                                    fa-fw"></i></a>

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

@stop