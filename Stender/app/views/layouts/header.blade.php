<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
    <head>
        <title>Stender @yield('title')</title>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ URL::to('favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ URL::to('favicon.ico') }}" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}" media="screen" />
        {{ HTML::style('packages/bootstrap/css/bootstrap.css', array('media' => 'screen, projection')) }}
@yield('custom-stylesheets')
        {{ HTML::script('packages/jquery/jquery.js') }}
        {{ HTML::script('packages/bootstrap/js/bootstrap.js') }}
@yield('jquery-scripts')
@yield('custom-scripts')
    </head>

    <body @yield('body-attributes')>
@yield('body')
    </body>
</html>