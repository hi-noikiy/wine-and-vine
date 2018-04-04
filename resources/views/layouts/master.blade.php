<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
</head>
<body>
<noscript>
    <div id="no-script-warning">This application needs JavaScript enabled in order to run at its best!</div>
</noscript>
<div id="app">
    @include('layouts.partials.navbar')
    <div class="container-fluid">
        <div class="row py-4">
            <div class="col d-none d-sm-block">
                @yield('left-content')
            </div>

            <div class="col-md-8">
                @yield('breadcrumb')
                @yield('content')
            </div>

            <div class="col d-none d-sm-block">
                @yield('right-content')
            </div>
        </div>
    </div>

    <notifications
        group="cart"
        position="bottom right"
    ></notifications>
</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>
</html>
