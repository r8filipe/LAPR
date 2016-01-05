@extends('layout.master')

@section('content')

        <!-- Page Heading/Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Detalhes
            <small>{{$oficina->nome}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/">Home</a>
            </li>
            <li class="active">{{$oficina->nome}}</li>
        </ol>
    </div>
</div>
<!-- /.row -->

<!-- Content Row -->
<div class="row">
    <!-- Map Column -->
    <div class="col-md-8">
        @if(session('sucess'))
            <div class="alert alert-success">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                {{ session('sucess') }}
            </div>
        @endif
        @if($errors->all())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $message)
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    {{$message}}<br/>
                @endforeach

            </div>
        @endif
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php $i = 0;?>
                @foreach ($oficina->imagens as $image)
                    <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
                    <?php $i++;?>
                @endforeach
            </ol>

            <!-- Wrapper for slides -->
            <div class="img-oficina">
                <div class="carousel-inner " role="listbox">
                    <?php $i = 0;?>
                    @foreach ($oficina->imagens as $image)

                        <div class="item {{$i== 0 ? 'active' :'' }}">
                            <img src="{{'/uploads/'.$image->url}}"/>
                        </div>
                        <?php $i++;?>
                    @endforeach

                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="panel panel-default details">
            <div class="panel-heading">Serviços</div>
            <div class="panel-body">
                @foreach($oficina->servico as $servico)
                    <abbr title="{{$servico->servico}}"><img src="/images/servicos/{{$servico->imagem}}"></abbr>
                @endforeach
            </div>
        </div>
        <div class="panel panel-default details">
            <div class="panel-heading">Veiculos</div>
            <div class="panel-body">
                @foreach($oficina->veiculo as $veiculo)
                    <abbr title="{{$veiculo->veiculos}}"><img src="/images/veiculos/{{$veiculo->imagem}}"></abbr>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Contact Details Column -->
    <div class="col-md-4">
        <h3>Contacto</h3>
        <p>
            {{$oficina->route}} {{$oficina->street_number}}<br>
            {{$oficina->localidade}}<br>
            {{$oficina->concelho}} - {{$oficina->distrito}}
        </p>
        <p>
            <abbr title="Phone"><i class="fa fa-phone"></i></abbr>:
            {{$oficina->international_phone_number}}</p>
        <p>
            <abbr title="Email"><i class="fa fa-envelope-o"></i></abbr>:
            <a href="mailto:{{$oficina->email}}">{{$oficina->email}}</a>
        </p>
        <ul class="list-unstyled list-inline list-social-icons">
            <li>
                <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
            </li>
        </ul>

        <p class="listing-detail">
            <abbr title="Estatísticas"><i class="fa fa-comment-o"></i></abbr>
                            <span data-toggle="tooltip" data-placement="bottom"
                                  data-original-title="Qualidade">5</span>
                            <span data-toggle="tooltip" data-placement="bottom"
                                  data-original-title="Preço">5</span>
                            <span data-toggle="tooltip" data-placement="bottom"
                                  data-original-title="Prazo">5</span>
                            <span data-toggle="tooltip" data-placement="bottom"
                                  data-original-title="Comentários">5</span>
                            <span data-toggle="tooltip" data-placement="bottom"
                                  data-original-title="Retorna">5</span>
        </p>
        <p>
            <!-- Embedded Google Map -->
            {!!$map['map_html']  !!}
        </p>
    </div>
</div>
<!-- /.row -->

<!-- Contact Form -->
<!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
<div class="row">
    <div class="col-md-8">
        <h3>Deixe a sua avaliação</h3>
        {!! Form::open((array('url'=>'/oficina/'.$oficina->hash, 'method'=>'post', 'class'=>'form-group'))) !!}
        <div class="control-group form-group {!! $errors->has('email') ? ' has-error' : '' !!}">
            <div class="controls">
                {!! Form::label('email', 'Confirmar Email',array('class'=>'"control-label'))!!}
                {!! Form::text('email',null,array('class' => 'form-control', 'placeholder'=>'email', 'data-validation-required-message'=>'Confirme o seu email')) !!}
                <p class="help-block"></p>
            </div>
        </div>
        <div class="form-group" style="float:right;">
            <div class="controls">
                {!! Form::checkbox('retorna','1',true, array('class' => 'form-control', 'name'=>'retorna',
                'data-toggle'=>'toggle','data-onstyle'=>'primary','data-on'=>'Voltarei', 'data-off'=>'Não Voltarei'))!!}
            </div>
        </div>
        <div class="control-group form-group">
            <div class="controls">
                {!! Form::label('qualidade', 'Qualidade')!!}
                {!! Form::text('qualidade','0',array('class' => 'form-control rating', 'name'=>'qualidade',
                 'data-symbol'=>'*','min'=>0 , 'max'=>5,'step'=>0.5, 'data-size'=>'xs')) !!}
            </div>
        </div>
        <div class="control-group form-group">
            <div class="controls">
                {!! Form::label('preco', 'Preço')!!}
                {!! Form::text('preco','0',array('class' => 'form-control rating', 'name'=>'preco',
                'data-symbol'=>'*','min'=>0 , 'max'=>5,'step'=>0.5, 'data-size'=>'xs')) !!}
            </div>
        </div>
        <div class="control-group form-group">
            <div class="controls">
                {!! Form::label('prazo', 'Prazo')!!}
                {!! Form::text('prazo','0',array('class' => 'form-control rating', 'name'=>'prazo',
                'data-symbol'=>'*','min'=>0 , 'max'=>5,'step'=>0.5, 'data-size'=>'xs')) !!}
            </div>
        </div>


        <div class="form-group form-group  {!! $errors->has('nome') ? ' has-error' : '' !!}">
            <div class="controls">
                {!! Form::label('title', 'Titulo',array('class'=>'"control-label'))!!}
                {!! Form::text('title',null,array('class' => 'form-control', 'placeholder'=>'Titulo',
                                    'required'=>'required', 'data-validation-required-message'=>'Titlo Obrigatório')) !!}
            </div>
        </div>
        <div class="control-group form-group">
            <div class="controls">
                <label>Comentario:</label>
                {!! Form::textarea('review', null,array('rows'=>'10','cols'=>'100','required'=>'required',
                            'class' => 'form-control', 'style'=>'max-width:100%','placeholder'=>'Texto Livre',
                            'data-validation-required-message'=>'Conteúdo obrigatório')) !!}
            </div>
        </div>
        <div id="success"></div>
        <!-- For success/fail messages -->
        {!! Form::hidden('invisible', $oficina->id, array('name' => 'id')) !!}
        {!! Form::submit('Comentar', array('class'=>'btn btn-primary text-right')) !!}
        {!! Form::close()!!}
    </div>
    <hr>
    {{-- */$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f')/* --}}
    @foreach ($oficina->reviews as $review)

        <div class="media">
            <a class="pull-left" href="#">
                <?php  $color = $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] .
                        $rand[rand(0, 15)] . $rand[rand(0, 15)];?>
                <span data-toggle="tooltip" data-placement="left" data-original-title="{{$review->user->name}}">
                            <img class="media-object img-rounded"
                                 src="http://placehold.it/64x64/{{$color}}/000000?text={!! substr($review->user->name,0,1) !!}"
                                 alt="">
                            </span>
            </a>

            <div class="media-body">
                <h4 class="media-heading">{{$review->title}}
                    <small>{{$review->created_at}}</small>
                </h4>
                {!! nl2br(e($review->review)) !!}

            </div>
        </div>
    @endforeach

</div>

@stop



