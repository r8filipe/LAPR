@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><a href="">Avaliação de {{$user->name}}</a></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading text-right">
                    <h3>Avaliação media {{$user->avaliations->avg('qualidade')}} de {{$user->avaliations->count()}}</h3>
                </div>
                <div class="panel-body">
                    @foreach($user->avaliations as $avaliations)
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading">{{$avaliations->user->name}}
                                    <small>{{$avaliations->created_at}}</small>
                                </h4>
                                {{$avaliations->review}}
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop