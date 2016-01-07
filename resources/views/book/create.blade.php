@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><a href="/">Livros</a></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Adicionar Livro</h1>
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
                    <div class="form-group">

                        {!! Form::open((array('url'=>'/book/create', 'method'=>'post','files' => true))) !!}

                        <div class="form-group{!! $errors->has('title') ? ' has-error' : '' !!}">
                            {!! Form::label('title', 'Titulo',array('class'=>'control-label'))!!}
                            {!! Form::text('title',null,array('class' => 'form-control', 'placeholder'=>'Titlo')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('subtitle') ? ' has-error' : '' !!}">
                            {!! Form::label('subtitle', 'Subtitulo',array('class'=>'control-label'))!!}
                            {!! Form::text('subtitle',null,array('class' => 'form-control', 'placeholder'=>'Subtitulo')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('publishedDate') ? ' has-error' : '' !!}">
                            {!! Form::label('publishedDate', 'Data Publicação',array('class'=>'control-label'))!!}
                            {!! Form::text('publishedDate',null, array('class' => 'form-control', 'placeholder'=>'Data Publicação')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('description') ? ' has-error' : '' !!}">
                            {!! Form::label('description', 'Descrição',array('class'=>'control-label'))!!}
                            {!! Form::textarea('description',null,array('class' => 'form-control', 'placeholder'=>'Descrição')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('language') ? ' has-error' : '' !!}">
                            {!! Form::label('language', 'Idioma',array('class'=>'control-label'))!!}
                            {!! Form::text('language',null,array('class' => 'form-control', 'placeholder'=>'Idioma')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('pages') ? ' has-error' : '' !!}">
                            {!! Form::label('pages', 'Nº Paginas',array('class'=>'control-label'))!!}
                            {!! Form::text('pages',null,array('class' => 'form-control', 'placeholder'=>'Nº Páginas')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('isbn10') ? ' has-error' : '' !!}">
                            {!! Form::label('isbn10', 'ISBN 10',array('class'=>'control-label'))!!}
                            {!! Form::text('isbn10',null,array('class' => 'form-control', 'placeholder'=>'ISBN 10')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('isbn13') ? ' has-error' : '' !!}">
                            {!! Form::label('isbn13', 'ISBN 13',array('class'=>'control-label'))!!}
                            {!! Form::text('isbn13',null,array('class' => 'form-control', 'placeholder'=>'ISBN 13')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('price_day') ? ' has-error' : '' !!}">
                            {!! Form::label('price_day', 'Preço por dia',array('class'=>'control-label'))!!}
                            {!! Form::text('price_day',null,array('class' => 'form-control', 'placeholder'=>'Preço por dia')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('price_bail') ? ' has-error' : '' !!}">
                            {!! Form::label('price_bail', 'Caução',array('class'=>'control-label'))!!}
                            {!! Form::text('price_bail',null,array('class' => 'form-control', 'placeholder'=>'Caução')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('price_sale') ? ' has-error' : '' !!}">
                            {!! Form::label('price_sale', 'Preço de Venda',array('class'=>'control-label'))!!}
                            {!! Form::text('price_sale',null,array('class' => 'form-control', 'placeholder'=>'Preço de Venda')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('publisher', 'Editora')!!}
                            {!!Form::select('publisher',
                            $publishers
                            ,
                            null,
                            ['class' => 'form-control', 'id'=>'publisher'])!!}
                        </div>

                        <div class="form-group addPublisher {!! $errors->has('newpublisher') ? ' has-error' : '' !!}">
                            {!! Form::label('newpublisher', 'Nova editora',array('class'=>'control-label'))!!}
                            {!! Form::text('newpublisher',null,array('class' => 'form-control', 'placeholder'=>'Editora')) !!}
                        </div>

                        <div class="form-group {!! $errors->has('authors') ? ' has-error' : '' !!}">
                            {!! Form::label('authors', 'Autores',array('class'=>'control-label'))!!}
                            {!! Form::text('authors',null,array('class' => 'form-control', 'placeholder'=>'Autores')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('collection', 'Categoria')!!}
                            {!!Form::select('collection',
                            $collections
                            ,
                            null,
                            ['class' => 'form-control', 'id'=>'publisher'])!!}
                        </div>


                        <div class="form-group {!! $errors->has('files[]') ? ' has-error' : '' !!}">
                            {!! Form::label('cover', 'Capa',array('class'=>'control-label'))!!}
                            {!! Form::file('cover',array('class' => 'form-control', 'id'=>'files' ,'required'=>'required')) !!}
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Preview Capa</h3>
                            </div>
                            <div class="panel-body">
                                <div id="thumbnail">
                                </div>
                            </div>
                        </div>

                        {!! Form::submit('Create') !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop