<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="height: 100%;">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title></title></head>
<body style="height: 100%; width: 100%; display: block; font-weight: 100; margin: 0; padding: 0;">
<div class="banner" style="width: 100%; height: 120px; background-color: #222;">
    <img src="{{ $message->embed('images/xbook.png')}}" alt="xbook"
         style="padding-left: 80px; padding-top: 15px; " height="90px"/>
</div>

<div class="content" style="text-align: left; display: block; margin-left: 120px; padding: 80px;" align="left">
    <div class="title" style="font-size: 16px; font-weight: bold; display: block;">
        Olá; {{$user->name}}
    </div>
    <div class="text" style="margin-top: 20px; font-size: 12px; display: block; line-height: 20px;">
        Olá; {!! $content !!}
    </div>
</div>
<div class="footer "
     style="margin-top: 20px; background-color: #222; background-image: url(images/bg.jpg); color: #999; width: 100%; height: 120px; padding: 20px 0;">

    <div class="box-right" style="margin-right: 25px; float: right; height: 70px; width: 23%;">
        <h4 style="color: #fff; border-bottom-width: 2px; border-bottom-style: solid; border-bottom-color: #131313; margin-bottom: 10px; padding-bottom: 10px;">
            Contacto</h4>

        <p><b>XBOOK</b><br/>
            <span class="glyphicon glyphicon-envelope"></span> geral@xbook.pt<br/>
        </p></div>
    <div class="box-right" style="margin-right: 25px; float: right; height: 70px; width: 23%;">
        <h4 style="color: #fff; border-bottom-width: 2px; border-bottom-style: solid; border-bottom-color: #131313; margin-bottom: 10px; padding-bottom: 10px;">
            Siga-nos</h4>
        <a href="#" title="follow me on Facebook"><img src="{{ $message->embed('images/facebook.png')}}" alt="facebook"
                                                       style="height: 45px;"/></a>
        <a href="#" title="follow me on Twitter"><img src="{{$message->embed('images/linkedin.png') }}" alt="twitter"
                                                      style="height: 45px;"/></a>
        <a href="#" title="follow me on Linkedin"><img src="{{ $message->embed('images/linkedin.png')}}" alt="linkedin"
                                                       style="height: 45px;"/></a>
        <a href="#" title="follow me on Dribble"><img src="{{ $message->embed('images/instagram.png')}}" alt="instagram"
                                                      style="height: 45px;"/></a>
    </div>
    <div class="box-right" style="margin-right: 25px; float: right; height: 70px; width: 23%;">

    </div>
    <div class="box-left" style="margin-left: 25px; float: right; height: 70px; width: 23%;">
        <img src="{{ $message->embed('images/xbook.png')}}" alt="xbook" height="75px"/>
    </div>
</div>

</body>
</html>
