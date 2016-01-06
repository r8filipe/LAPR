@include('includes.header')

        <!-- Navigation -->
<link href="http://cdn.phpoll.com/css/animate.css" rel="stylesheet">
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="/images/xbook.png" style="width: 50%; margin-top:-15%"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(!Auth::check())
                    <li class="dropdown">
                        <a href="/auth/login" class="dropdown-toggle" data-toggle="dropdown">Register <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-lr animated slidedown" role="menu">
                            <div class="col-lg-10 col-sm-offset-1">
                                <div class="text-center"><h3><b>Register</b></h3></div>
                                {!! Form::open((array('url'=>'/auth/register', 'method'=>'post', 'class'=>'form-horizontal', 'autocomplete'=>'off'))) !!}
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
                                                   tabindex="4" class="form-control btn btn-info" value="Register Now">
                                        </div>
                                    </div>
                                </div>
                                {!!Form::close()!!}
                            </div>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="/auth/login" class="dropdown-toggle" data-toggle="dropdown">Log In <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-lr animated slideInRight" role="menu">
                            <div class="col-lg-10 col-sm-offset-1">
                                <div class="text-center"><h3><b>Log In</b></h3></div>
                                {!! Form::open((array('url'=>'/auth/login', 'method'=>'post', 'class'=>'form-horizontal'))) !!}
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
                            </div>
                        </ul>
                    </li>
                @else

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" id="opcoes">{{Auth::user()->name}}<span
                                    class="caret"></span></a>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="opcoes">
                            <li><a href="/book/create">Inserir Anuncio</a></li>
                            <li><a href="/book/list">Meus Anuncios</a></li>
                            <li><a href="/historico">Histórico</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/auth/logout">Logout</a></li>
                        </ul>
                    </li>
                    @if(Session::has('cart'))
                        @foreach(Session::get('cart') as $items)
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" id="cart"><i
                                            class="fa fa-shopping-cart"></i> Carrinho<span
                                            class="caret"></span></a>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="cart">

                                    @foreach($items as $item)
                                        <li><a href="#">{{\App\Book::select('title')->find($item)->title}}</a></li>
                                    @endforeach
                                    <li role="separator" class="divider"></li>
                                    <li><a href="/cart/clear">Limpar Carrinho</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="/cart/show">Avançar</a></li>
                                </ul>
                            </li>
                        @endforeach
                    @endif
                    @if(Auth::user()->role == 4)
                        <li><a href="/backend">Admin</a></li>
                    @endif
                @endif

            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container">
    @yield('content')
</div>
<!-- /.container -->

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-3">
                <ul class="row">
                    <img src="/images/xbook.png" style="width: 40%;">
                </ul>
            </div>
            <div class="col-lg-3 col-sm-3">
                <h4>Informações</h4>
                <ul class="row">
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="/about.php">Sobre Nós</a></li>
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="/auth/login">Registar</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-sm-3 ">
                <h4>Siga-nos</h4>
                <a href="#" title="follow me on Facebook"><img src="{{ URL::asset('images/facebook.png')}}"
                                                               alt="facebook"></a>
                <a href="#" title="follow me on Twitter"><img src="{{ URL::asset('images/twitter.png')}}" alt="twitter"></a>
                <a href="#" title="follow me on Linkedin"><img src="{{ URL::asset('images/linkedin.png')}}"
                                                               alt="linkedin"></a>
                <a href="#" title="follow me on Dribble"><img src="{{ URL::asset('images/instagram.png')}}"
                                                              alt="instagram"></a>
            </div>

            <div class="col-lg-3 col-sm-3">
                <h4>Contacto</h4>

                <p><b>XBOOK</b><br>
                    <span class="glyphicon glyphicon-envelope"></span> geral@xbook.pt<br>
            </div>
        </div>
        <p class="copyright">Copyright 2015. All rights reserved. - XBOOK</p>

    </div>
</div>
<!-- /.container -->

@include('includes.footer')
