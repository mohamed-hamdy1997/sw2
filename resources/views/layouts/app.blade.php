@@ -1,24 +1,46 @@
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html>
<head>

    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/post.css')}}" rel="stylesheet" type="text/css">

    <link href="https://bootswatch.com/lumen/bootstrap.css" rel="stylesheet" type="text/css">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title> Social Media __SW-2__ </title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
    <script type="text/javascript" src="{{asset('js/jquery.app.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



    <link href="https://bootswatch.com/lumen/bootstrap.css" rel="stylesheet" type="text/css">


    <style>
        .navbar.navbar-inverse {

            border: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }


    </style>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
@ -33,7 +55,17 @@
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                       @if (!\auth::guest())
                        @if(Auth::user()->rolls->roll=='admin')
                            <li class="nav-item">
                                <a class="nav-link" href="/companies">Companies</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/employees">Employees</a>
                            </li>
                            @endif
                           @endif
                    </ul>

                    <!-- Right Side Of Navbar -->