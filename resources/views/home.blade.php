@extends('layout.master')

@section('content')
    {{--{{dd($books)}}--}}
    <div class="col-md-12" style="padding-top:90px">
        <div class="well">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search ">
                    <a href="#" style="font-size:1.2em"><i class="fa fa-search fa-fw"></i>
                        Pesquisar<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level" style="margin-top:25px;">
                        <li>
                            {!! Form::open((array('url'=>'/', 'method'=>'get', 'class'=>'form-inline pesquisa'))) !!}
                            <div class="form-group">
                                {!! Form::label('title', 'Titulo',array('class'=>'"control-label'))!!}
                                {!! Form::text('title',null,array('class' => 'form-control', 'placeholder'=>'Titulo')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('author', 'Autor',array('class'=>'"control-label'))!!}
                                {!! Form::text('author',null,array('class' => 'form-control', 'placeholder'=>'Autor')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('collection', 'Categoria')!!}
                                {!!Form::select('collection',
                                $collections
                                ,
                                null,
                                ['class' => 'form-control', 'id'=>'publisher'])!!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('sort', 'Ordem')!!}
                                {!! Form::select('sort', array(''=>'','ASC' => 'ASCENDENTE', 'DESC' => 'DESCENDENTE'),null,
                                ['class' => 'form-control', 'id'=>'sort'])!!}
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="icon-circle-arrow-right icon-large"></i> <i class="fa fa-search fa-fw"></i>
                            </button>
                            {!!Form::close()!!}
                        </li>
                    </ul>
                </li>
            </ul>

        </div>

        <?php $i = 1;?>

        @foreach($books as $book)
            {!!  $i %3 == 0 ? '<div class="row">' : ''!!}
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <div class=" col-md-4">
                        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($book['cover']) . '" />';?>
                    </div>
                    <div class="col-md-8" style="height: 150px; margin-top:25px;">
                        <p class="text-right important">Aluguer: <span class="bold">€ {{$book->price_day}}</span></p>
                        <p class="text-right important">Venda: <span class="bold">€ {{$book->price_sale}}</span></p>
                        <p class="text-right important">Caução: <span class="bold ">€ {{$book->price_bail}}</span></p>
                    </div>
                    <div class="caption">
                        <h4><a href="/book/{{urlencode($book->title)}}">{{$book->title}}</a>
                        </h4>

                        <p><span class="dataLabel">Subtitulo:</span>{{$book->subtitle}} </p>

                        <p>
                            <span class="dataLabel">Preço: </span>{{$book->price_sale}}
                        </p>

                        <p><span class="dataLabel">Autor(es): </span>
                            @foreach($book->authors as $author)
                                {{$author->name}} |
                            @endforeach
                        </p>


                        <div class="collapse list" id="book_{{$book->id}}">
                            <div class="col-xs-12 col-sm-12 col-lg-12 " style="padding: 0">
                                <p class="text-left"><span class="bold">Descrição: </span>{{$book->description}}</p>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <p class="text-left"><span class="bold">ISBN-10: </span>{{$book->isbn10}}</p>
                                <p class="text-left"><span class="bold">ISBN-13: </span>{{$book->isbn13}}</p>
                                <p class="text-left"><span class="bold">Idioma: </span>{{$book->language}}</p>
                                <p class="text-left"><span class="bold">Páginas: </span>{{$book->pages}}</p>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <p class="text-left"><span class="bold">Editora </span>
                                    {{isset($book->publisher->publisher) ? $book->publisher->publisher : $book->publisher->publisher}}
                                </p>
                                <p class="text-left"><span class="bold">Coleção </span>
                                    @foreach($book->collections as $collection)
                                        {{$collection->collection}}
                                    @endforeach</p>
                                <p class="text-right"><a href='cart/add/{{$book->id}}' data-toggle="tooltip"
                                                         data-placement="top"
                                                         title="Adicionar Carrinho"><i
                                                class="fa fa-shopping-cart"></i></a>
                                </p>
                            </div>
                        </div>
                        <p class="text-right" style="cursor: pointer;">
						<span data-toggle="collapse" href="#book_{{$book->id}}" aria-expanded="false"
                              aria-controls="book_{{$book->id}}"
                              class="glyphicon glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                        </p>
                    </div>


                </div>
            </div>
            {!!  $i %3 == 0 ? '</div>' : ''!!}
            <?php $i++;?>
        @endforeach

    </div>
    <div class="col-sm-12 col-lg-12 col-md-12">
        @if(!isset($url))
            {!! $books->render() !!}
        @else
            {!! $books->appends($url)->render() !!}
        @endif
    </div>
@stop