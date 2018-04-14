<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Wine & Vine') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <script>
        window.auth = {
            user: {!! json_encode(auth()->user()) !!}
        }
    </script>
<body class="bg-grey-lighter">
{{--Tighten CO Ziggy specific directive--}}
@routes
<noscript>
    <div id="no-script-warning"
    >This application needs JavaScript enabled in order to run at its best!
    </div>
</noscript>
<div id="app">
    @include('layouts.partials.navbar')


    <div class="mt-3">
        <div class="container mx-auto">
            <div class="flex">
                {{--Left Partial--}}
                <div class="hidden lg:block lg:w-1/4">
                    @yield('left-content')
                </div>

                {{--Center Partial--}}
                <div class="w-full lg:w-1/2 mx-auto lg:px-2">
                    {{--    @yield('breadcrumb')--}}
                    @yield('content')
                </div>

                {{--Right Partial--}}
                <div class="hidden lg:block lg:w-1/4">
                    @yield('right-content')
                </div>
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
