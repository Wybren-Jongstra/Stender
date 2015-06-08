<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Nieuwe connectie!</h2>

        <div>
            {{ $DisplayName }} wil je toevoegen als connectie. <br />
            <a href="{{ URL::to('connection/' . $id . '/'. $usrID .'/true') }}">Accepteren</a> <a href="{{ URL::to('connection/' . $id . '/'. $usrID .'/false') }}">Niet accepteren</a>.<br />
        </div>

    </body>
</html>