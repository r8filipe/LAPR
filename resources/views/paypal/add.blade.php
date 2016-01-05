@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><a href="/">Conta</a></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Adicionar Fundos</h1>
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

                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="7GYJW4NLBHMYA">
                            <input type="image" src="https://www.paypalobjects.com/pt_PT/PT/i/btn/btn_buynowCC_LG.gif"
                                   border="0" name="submit"
                                   alt="PayPal - A forma mais fácil e segura de efetuar pagamentos online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/pt_PT/i/scr/pixel.gif" width="1"
                                 height="1">
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@stop