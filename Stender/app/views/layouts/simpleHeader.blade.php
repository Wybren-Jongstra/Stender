<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="{{ URL::to('favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ URL::to('favicon.ico') }}" type="image/x-icon">
        {{ HTML::style('css/style.css', array('media' => 'screen, projection')) }}
        {{ HTML::style('packages/bootstrap/css/bootstrap.css', array('media' => 'screen, projection')) }}
        @yield('custom-scripts')
    </head>
    <body>
        <noscript>
            @yield('no-script')
        </noscript>
    </body>
</html>