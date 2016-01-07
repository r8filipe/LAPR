<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Portal XBOOK</title>

    <!--JQUERY-->
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    {{--<link href="/css/responsive.dataTables.css" rel="stylesheet">--}}

            <!-- Custom Fonts -->
    <link href="/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!--TOOGLE-->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap2-toggle.min.css" rel="stylesheet">

    <!--Image Preview-->
    <link href="/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

    <!-- Morris Charts CSS -->
    <link href="/admin/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/admin/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    @if(isset($map))
    {!!   '<script type="text/javascript">var centreGot = false;</script>' !!}
    {!! $map['map_js'] !!}
    @endif

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--RATING-->
    <link rel="stylesheet" href="/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="/js/star-rating.js" type="text/javascript"></script>


</head>

<body>