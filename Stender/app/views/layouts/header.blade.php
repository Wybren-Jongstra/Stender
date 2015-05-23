<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
    <head>
        <title>Stender home</title>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="shortcut icon" href="{{ URL::to('favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ URL::to('favicon.ico') }}" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}" media="screen" />
@yield('custom-stylesheets')
        <link type="text/css" href="{{ URL::to('css/bootstrap.css') }}" rel="stylesheet" media="screen, projection" />
        <!-- <link type="text/css" href="{{ URL::to('css/bootstrap.min.css') }}" rel="stylesheet" media="screen, projection" /> -->

        <script src="{{ URL::to('js/jquery.min.js') }}"></script>
@yield('jquery-scripts')
        <script src="{{ URL::to('js/bootstrap.js') }}"></script>
        <!-- <script src="{{ URL::to('js/bootstrap.min.js') }}"></script> -->

@yield('custom-scripts')
    </head>

    <body @yield('body-attributes')>
@yield('body')
    </body>
</html>