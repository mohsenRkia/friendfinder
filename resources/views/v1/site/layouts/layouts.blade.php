<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is social network html5 template available in themeforest......" />
    <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
    <meta name="robots" content="index, follow" />
    <title>Friend Finder | A Complete Social Network Template</title>

    <!-- Stylesheets
    ================================================= -->
    <link rel="stylesheet" href="/css/app.css" />

    <link rel="stylesheet" href="/css/ionicons.min.css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/mystyle.css" />
    <!--Google Webfont-->
    <link href='/css/fontegoogle.css' rel='stylesheet' type='text/css'>
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="/images/fav.png"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>

<!-- Header -->
@include('v1.site.layouts.header')
<!--Header End-->


<!-- Content -->
@yield('content')
<!-- Content End -->




<!-- Footer -->
@include('v1.site.layouts.footer')




<!--preloader-->
<div id="spinner-wrapper">
    <div class="spinner"></div>
</div>

<!-- Scripts
================================================= -->

<script src="/js/app.js"></script>
<script src="/js/jquery.appear.min.js"></script>
<script src="/js/jquery.incremental-counter.js"></script>
<script src="/js/script.js"></script>

</body>
</html>
