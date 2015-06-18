<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2 style="color: #013a75;">Nieuwe review!</h2>

<div>
    {{ $fromName }} heeft een review over jou geschreven. <br />
    Klik <a href="{{ URL::to('profile/'.$profUrl) }}">hier</a> om de review te bekijken.
</div>

</body>
</html>