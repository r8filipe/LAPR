@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><a href="/auth/login">Autenticação</a></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style="border:none;">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-login ">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="#" class="active" id="login-form-link">Login</a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="#" id="register-form-link">Register</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-10 col-sm-offset-1">

                                    {!! Form::open((array('url'=>'/auth/login', 'method'=>'post', 'class'=>'form-horizontal', 'id' =>'login-form'))) !!}
                                    <div class="form-group">
                                        {!! Form::label('email', 'Email',array('class'=>'"control-label'))!!}
                                        {!! Form::text('email',null,array('class' => 'form-control',
                                                'placeholder'=>'email','value'=>old('email') )) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('password', 'Password')!!}
                                        {!! Form::password('password',array('class' => 'form-control',
                                        'placeholder'=>'Password')) !!}
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-7">
                                                {!! Form::checkbox('remember',null,false, array('class' => 'form-inline'))!!}
                                                <label for="remember"> Remember Me</label>
                                            </div>
                                            <div class="col-xs-5 pull-right">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4"
                                                       class="form-control btn btn-success" value="Log In">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <a href="http://phpoll.com/recover" tabindex="5"
                                                       class="forgot-password">Forgot Password?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {!!Form::close()!!}

                                    {!! Form::open((array('url'=>'/auth/register', 'method'=>'post', 'class'=>'form-horizontal', 'autocomplete'=>'off', 'id' =>'register-form','style'=>'display: none' ))) !!}
                                    <div class="form-group">
                                        {!! Form::text('name',null,array('class' => 'form-control', 'placeholder'=>'Nome', 'data-validation-required-message'=>'nome obrigatório')) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::text('email',null,array('class' => 'form-control', 'placeholder'=>'Email',
                                         'data-validation-required-message'=>'email obrigatório')) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::password('password',array('class' => 'form-control','tabindex'=>'2','placeholder'=>'Password')) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::password('password_confirmation',array('class' => 'form-control',
                                        'placeholder'=>'Please confirm password', 'data-validation-required-message'=>'password obrigatória')) !!}
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-6 col-xs-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit"
                                                       tabindex="4" class="form-control btn btn-info"
                                                       value="Register Now">
                                            </div>
                                        </div>
                                    </div>
                                    {!!Form::close()!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop