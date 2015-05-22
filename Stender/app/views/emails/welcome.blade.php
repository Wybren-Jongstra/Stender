<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Your Email Address!</h2>

        <div>
            Thanks for creating a Stender account. <br />
            Please follow the link below to verify your email address:<br />
            {{ URL::to('verify/' . $confirmationCode) }}.<br />

        </div>

    </body>
</html>