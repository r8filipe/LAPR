@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><a href="">Meus Anuncios</a></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Meus Anuncios</h1>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    @if($errors->all())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $message)
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                {{$message}}<br/>
                            @endforeach

                        </div>
                    @endif
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-listBook">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titlo</th>
                                    <th>Subtitulo</th>
                                    <th>Linguagem</th>
                                    <th>Authores</th>
                                    <th>Categorias</th>
                                    <th>Preço Dia</th>
                                    <th>Preço Venda </th>
                                    <th>Caução</th>
                                    <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($books as $book)
                                    <tr>
                                        <td>{{$book->id}}</td>
                                        <td>{{$book->title}} </td>
                                        <td> {{$book->subtitle}}</td>
                                        <td>{{$book->language}} </td>
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
                                        <td>€ {{$book->price_day}}</td>
                                        <td>€ {{$book->price_sale}}</td>
                                        <td>€ {{$book->price_bail}}</td>
                                        <td>
                                            <a href="/book/edit/{{$book->id}}"><i
                                                        class="fa fa-edit fa-fw"></i></a>
                                            <a href="/book/remove/{{$book->id}}"><i class="fa
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

                </div>
            </div>
        </div>
    </div>
@stop