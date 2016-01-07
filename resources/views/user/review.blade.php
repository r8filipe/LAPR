@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><a href="">Avaliar {{$user->name}}</a></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Avaliação {{$user->name}}</h1>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::open((array('url'=>'/user/review', 'method'=>'post'))) !!}
                        {!! Form::hidden('user',$user->id) !!}
                        {!! Form::hidden('payment',$payment) !!}
                        {!! Form::hidden('book',$book) !!}
                        <div class="form-group{!! $errors->has('descricao') ? ' has-error' : '' !!}">
                            {!! Form::label('descricao', 'Descrição',array('class'=>'control-label'))!!}
                            {!! Form::textarea('descricao',null,array('class' => 'form-control', 'placeholder'=>'Descrição', 'required' => 'required')) !!}
                        </div>
                        <div class="form-group {!! $errors->has('subtitle') ? ' has-error' : '' !!}">
                            {!! Form::label('avaliacao', 'Avaliação de 1 a 5',array('class'=>'control-label'))!!}
                            {!! Form::number('avaliacao',null,array('class' => 'form-control', 'placeholder'=>'5', 'required' => 'required')) !!}
                        </div>
                        <button type="submit" class="btn btn-success text-right">
                            <i class="icon-circle-arrow-right icon-large"></i> Avaliar
                        </button>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop