@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><a href="/">Histórico</a></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Histórico</h1>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search ">
                            <a href="#" style="font-size:1.2em"><i class="fa fa-shopping-cart"></i></i>
                                Compras<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level" style="margin-top:25px;">
                                <li>
                                    <div class="panel-body">
                                        <div class="dataTable_wrapper">
                                            <table class="table table-striped table-bordered table-hover"
                                                   id="dataTables-listCompras">
                                                <thead>
                                                <tr>
                                                    <th>Compra</th>
                                                    <th>Artigo</th>
                                                    <th>Preço</th>
                                                    <th>Data</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($purchases as $purchase)
                                                    @foreach( $purchase->transaction as $item)
                                                        <tr>
                                                            <td>{{$item->payment_id}}</td>
                                                            <td>{{$item->book->title}}</td>
                                                            <td class="text-right">€{{$item->price}}</td>
                                                            <td class="text-center">{{$item->created_at}}</td>

                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-search ">
                            <a href="#" style="font-size:1.2em"><i class="fa fa-money"></i></i>
                                Vendas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level" style="margin-top:25px;">
                                <li>
                                    <div class="panel-body">
                                        <div class="dataTable_wrapper">
                                            <table class="table table-striped table-bordered table-hover"
                                                   id="dataTables-listVendas">
                                                <thead>
                                                <tr>
                                                    <th>Venda</th>
                                                    <th>Artigo</th>
                                                    <th>Preço</th>
                                                    <th>Data</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($sales as $sale)
                                                    <tr>
                                                        <td>{{$sale->payment_id}}</td>
                                                        <td>{{$sale->book->title}}</td>
                                                        <td class="text-right">€{{$sale->price}}</td>
                                                        <td class="text-center">{{$sale->created_at}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop