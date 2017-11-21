<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Olimp') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet">
    @yield('headerScripts')
</head>

<body>
<header>
    @include('backend.partials.nav')
</header>

<div class="container-fluid">
    <div class="row d-flex d-md-block flex-nowrap wrapper">
        @auth()
            @include('backend.partials.sidenav')
        @endauth

        <main role="main" class="col-sm-10 float-left col px-5 pl-md-2 pt-2 main ">

            <h1>
                <a href="#" data-target="#sidebar" data-toggle="collapse"><i class="fa fa-navicon py-2 p-1"></i></a>
                @yield('pageTitle')
            </h1>

            <div id="app">
                @include('backend.partials.nav')

                @yield('content')
            </div>
        </main>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<!-- Scripts -->
<script src="{{ asset('js/backend.js') }}"></script>
@yield('footerScripts')
</body>
</html>
