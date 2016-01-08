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
                                <th>Anuncios Activos</th>
                                <th>Compras</th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->books->sum('active')}}</td>
                                    <td>{{count($user->payments)}}</td>
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
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

@stop