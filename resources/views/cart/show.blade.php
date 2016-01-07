@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><a href="/">Carrinho</a></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    {!! Form::open((array('url'=>'/payment', 'method'=>'post', 'class'=>'form-inline pesquisa'))) !!}
                    <table class="table table-striped table-bordered table-hover" id="dataTables-listBook">
                        <thead>
                        <tr>
                            <th class="text-center">Titlo</th>
                            <th class="text-center">Venda / Aluguer / Caução</th>
                            <th class="text-center">Comprar</th>
                            <th class="text-center">Alugar</th>
                            <th class="text-center">Remover</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{$book->title}} </td>

                                <td class="text-right">€ {{$book->price_sale}} / {{$book->price_day}}
                                    / {{$book->price_bail}}</td>
                                <td class="text-center">{!! Form::radio('option['.$book->id.'][]', 'buy', true) !!}</td>
                                <td class="text-center">{!! Form::radio('option['.$book->id.'][]', 'rent') !!}
                                    {!! Form::text('option['.$book->id.'][day]', null) !!}
                                </td>
                                <td class="text-center"><a href="/cart/remove/{{$book->id}}"><i
                                                class="fa fa-times fa-fw"></i></a></td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">
                        <i class="icon-circle-arrow-right icon-large"></i>Efectuar Pagamento</i>
                    </button>
                    {!!Form::close()!!}
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
@stop