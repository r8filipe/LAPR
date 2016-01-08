@extends('layout.master')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><a href="">Histórico</a></h1>
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
                                                    <th>Avaliação</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $compras = 0;?>
                                                @foreach($purchases as $purchase)
                                                    <tr>
                                                        <td>{{$purchase->payment_id}}</td>
                                                        <td>{{$purchase->book->title}}</td>
                                                        <td class="text-right">
                                                            €
                                                            @foreach($purchase->transaction as $transaction)
                                                                @if($transaction->book_id == $purchase->book_id)
                                                                    {{$transaction->price}}
                                                                    <?php $compras += $transaction->price;?>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td class="text-center">{{$purchase->created_at}}</td>
                                                        <td class="text-center">
                                                            {{--*/ $rev = false /*--}}
                                                            @foreach($user->reviews as $review)
                                                                @if($review['payment_id'] == $purchase->payment_id
                                                                    && $review['user_id_reviewer'] == $purchase->book->id_user )
                                                                    {{--*/ $rev = true /*--}}
                                                                @endif
                                                            @endforeach

                                                            @if($rev == false)
                                                                <a href="/user/review/{{$purchase->book->id_user}}/{{$purchase->payment_id}}/{{$purchase->book->id}}
                                                                        ">Avaliar</a>
                                                            @else
                                                                <a href="/user/review/{{$purchase->book->id_user}}">Rever</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="text-right">Total de vendas <span
                                                        class="bold important"> € {{$compras}}</span></div>
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
                                            <div class="text-right">Total de vendas <span
                                                        class="bold important"> € {{$sales->sum('price')}}</span></div>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-search ">
                            <a href="#" style="font-size:1.2em"><i class="fa fa-history"></i>
                                Alugueres<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level" style="margin-top:25px;">
                                <li>
                                    <div class="panel-body">
                                        <div class="dataTable_wrapper">
                                            <table class="table table-striped table-bordered table-hover"
                                                   id="dataTables-listRental">
                                                <thead>
                                                <tr>
                                                    <th>Aluguer</th>
                                                    <th>Artigo</th>
                                                    <th>Data Inicio</th>
                                                    <th>Data Final</th>
                                                    <th>Preço</th>
                                                    <th>Devolver</th>
                                                    <th>Avaliar</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $compras = 0;?>
                                                @foreach($rentals as $rental)
                                                    <tr>
                                                        <td>{{$rental->payment_id}}</td>
                                                        <td>{{$rental->book->title}}</td>
                                                        <td>{{$rental->start}}</td>
                                                        <td>{{$rental->end}}</td>
                                                        <td class="text-right">
                                                            €
                                                            @foreach($rental->transaction as $transaction)
                                                                @if($transaction->book_id == $rental->book_id)
                                                                    {{$transaction->price}}
                                                                    <?php $compras += $transaction->price;?>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td class="text-center">
                                                            @if(!isset($rental->returns->confirmed))
                                                                <a href="/book/return/{{ $rental->id}}"><i
                                                                            class="fa fa-history"></i></a>
                                                            @elseif(isset($rental->returns->confirmed) && $rental->returns->confirmed == 1 )
                                                                <i class="fa fa-check"></i>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            {{--*/ $rev = false /*--}}
                                                            @foreach($user->reviews as $review)

                                                                @if($review['payment_id'] == $rental->payment_id
                                                                && $review['user_id_reviewer'] == $rental->book->id_user)
                                                                    {{--*/ $rev = true /*--}}
                                                                @endif
                                                            @endforeach

                                                            @if($rev == false)
                                                                <a href="/user/review/{{$rental->book->id_user}}/{{$rental->payment_id}}/{{$rental->book->id}}
                                                                        ">Avaliar</a>
                                                            @else
                                                                <a href="/user/review/{{$rental->book->id_user}}">Rever</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="text-right">Total de vendas <span
                                                        class="bold important"> € {{$compras}}</span></div>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-search ">
                            <a href="#" style="font-size:1.2em"><i class="fa fa-history"></i>
                                Meus Alugueres<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level" style="margin-top:25px;">
                                <li>
                                    <div class="panel-body">
                                        <div class="dataTable_wrapper">
                                            <table class="table table-striped table-bordered table-hover"
                                                   id="dataTables-listMyRental">
                                                <thead>
                                                <tr>
                                                    <th>Aluguer</th>
                                                    <th>Artigo</th>
                                                    <th>Data Inicio</th>
                                                    <th>Data Final</th>
                                                    <th>Preço</th>
                                                    <th>Confirmar Devolução</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $aluguer = 0;?>
                                                @foreach($myRentals as $myYental)
                                                    <tr>
                                                        <td>{{$myYental->payment_id}}</td>
                                                        <td>{{$myYental->book->title}}</td>
                                                        <td>{{$myYental->start}}</td>
                                                        <td>{{$myYental->end}}</td>
                                                        <td class="text-right">
                                                            €
                                                            @foreach($myYental->transaction as $transaction)
                                                                @if($transaction->book_id == $myYental->book_id)
                                                                    {{$transaction->price}}
                                                                    <?php $aluguer += $transaction->price;?>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td class="text-center">
                                                            {{--{{$myYental->returns->confirmed}}--}}
                                                            @if(isset($myYental->returns->confirmed) && $myYental->returns->confirmed == 0)
                                                                <a href="/book/returnConfirmed/{{ $myYental->id}}"><i
                                                                            class="fa fa-check"></i></a>
                                                            @elseif(isset($myYental->returns->confirmed) && $myYental->returns->confirmed == 1)
                                                                <i class="fa fa-check"></i>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="text-right">Total em Alugueres <span
                                                        class="bold important"> € {{$aluguer}}</span></div>
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