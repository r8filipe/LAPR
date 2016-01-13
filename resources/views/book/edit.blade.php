@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><a href="">{{$book->title}}</a></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Editar Livro</h1>
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

                        {!! Form::open((array('url'=>'/book/edit', 'method'=>'post','files' => true))) !!}
                        {!! Form::hidden ('id',$book->id) !!}
                        <div class="form-group{!! $errors->has('title') ? ' has-error' : '' !!}">
                            {!! Form::label('title', 'Titulo',array('class'=>'control-label'))!!}
                            {!! Form::text('title',$book->title,array('class' => 'form-control', 'placeholder'=>'Titlo')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('subtitle') ? ' has-error' : '' !!}">
                            {!! Form::label('subtitle', 'Subtitulo',array('class'=>'control-label'))!!}
                            {!! Form::text('subtitle',$book->subtitle,array('class' => 'form-control', 'placeholder'=>'Subtitulo')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('publishedDate') ? ' has-error' : '' !!}">
                            {!! Form::label('publishedDate', 'Data Publicação',array('class'=>'control-label'))!!}
                            {!! Form::text('publishedDate',$book->publishedDate, array('class' => 'form-control', 'placeholder'=>'Data Publicação')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('description') ? ' has-error' : '' !!}">
                            {!! Form::label('description', 'Descrição',array('class'=>'control-label'))!!}
                            {!! Form::textarea('description',$book->description,array('class' => 'form-control', 'placeholder'=>'Descrição')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('language') ? ' has-error' : '' !!}">
                            {!! Form::label('language', 'Idioma',array('class'=>'control-label'))!!}
                            {!! Form::text('language',$book->language,array('class' => 'form-control', 'placeholder'=>'Idioma')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('pages') ? ' has-error' : '' !!}">
                            {!! Form::label('pages', 'Nº Paginas',array('class'=>'control-label'))!!}
                            {!! Form::text('pages',$book->pages,array('class' => 'form-control', 'placeholder'=>'Nº Páginas')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('isbn10') ? ' has-error' : '' !!}">
                            {!! Form::label('isbn10', 'ISBN 10',array('class'=>'control-label'))!!}
                            {!! Form::text('isbn10',$book->isbn10,array('class' => 'form-control', 'placeholder'=>'ISBN 10')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('isbn13') ? ' has-error' : '' !!}">
                            {!! Form::label('isbn13', 'ISBN 13',array('class'=>'control-label'))!!}
                            {!! Form::text('isbn13',$book->isbn13,array('class' => 'form-control', 'placeholder'=>'ISBN 13')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('price_day') ? ' has-error' : '' !!}">
                            {!! Form::label('price_day', 'Preço por dia',array('class'=>'control-label'))!!}
                            {!! Form::text('price_day',$book->price_day,array('class' => 'form-control', 'placeholder'=>'Preço por dia')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('price_bail') ? ' has-error' : '' !!}">
                            {!! Form::label('price_bail', 'Caução',array('class'=>'control-label'))!!}
                            {!! Form::text('price_bail',$book->price_bail,array('class' => 'form-control', 'placeholder'=>'Caução')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('price_sale') ? ' has-error' : '' !!}">
                            {!! Form::label('price_sale', 'Preço de Venda',array('class'=>'control-label'))!!}
                            {!! Form::text('price_sale',$book->price_sale,array('class' => 'form-control', 'placeholder'=>'Preço de Venda')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('publisher', 'Editora')!!}
                            {!!Form::select('publisher',
                            $publishers
                            ,
                            $book->id_publisher,
                            ['class' => 'form-control', 'id'=>'publisher'])!!}
                        </div>

                        <div class="form-group addPublisher {!! $errors->has('newpublisher') ? ' has-error' : '' !!}">
                            {!! Form::label('newpublisher', 'Nova editora',array('class'=>'control-label'))!!}
                            {!! Form::text('newpublisher',null,array('class' => 'form-control', 'placeholder'=>'Editora')) !!}
                        </div>
                        <?php
                        $authors = '';
                        foreach ($book->authors as $item) {
                            $authors .= ',' . $item->name;
                        }
                        $authors = substr($authors, 1);
                        ?>
                        <div class="form-group {!! $errors->has('authors') ? ' has-error' : '' !!}">
                            {!! Form::label('authors', 'Autores',array('class'=>'control-label'))!!}
                            {!! Form::text('authors',$authors,array('class' => 'form-control', 'placeholder'=>'Autores')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('collection', 'Categoria')!!}
                            {!!Form::select('collection',
                            $collections
                            ,
                            $book->collection_id,
                            ['class' => 'form-control', 'id'=>'publisher'])!!}
                        </div>


                        <div class="form-group {!! $errors->has('files[]') ? ' has-error' : '' !!}">
                            {!! Form::label('cover', 'Capa',array('class'=>'control-label'))!!}
                            {!! Form::file('cover',array('class' => 'form-control', 'id'=>'files')) !!}
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Preview Capa</h3>
                            </div>
                            <div class="panel-body">
                                <div id="thumbnail">
                                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($book['cover']) . '" />';?>
                                </div>
                            </div>
                        </div>

                        {!! Form::submit('Edit') !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop