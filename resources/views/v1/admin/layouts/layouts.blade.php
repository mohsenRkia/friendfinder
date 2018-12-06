<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/admin/rtl/bootstrap.min.css" rel="stylesheet">

    <!-- not use this in ltr -->
    <link href="/css/admin/rtl/bootstrap.rtl.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/css/admin/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="/css/admin/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/admin/rtl/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/css/admin/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/css/admin/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="/js/admin/google/html5shiv.js"></script>
    <script src="/js/admin/googlerespond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
@include('v1.admin.layouts.navigation')


@yield('content')

<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery Version 1.11.0 -->
<script src="/js/admin/jquery-1.11.0.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/js/admin/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="/js/admin/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="/js/admin/raphael/raphael.min.js"></script>
<script src="/js/admin/morris/morris.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="/js/admin/sb-admin-2.js"></script>

</body>

</html>
