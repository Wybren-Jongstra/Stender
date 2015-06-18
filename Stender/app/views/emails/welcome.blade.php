<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2 style="color: #013a75;">Verifieer je e-mailadres!</h2>

        <div>
            Bedankt voor het registreren op Stender. <br />
            Klik op de link hieronder om je e-mailadres te verifiëren.<br />
            {{ URL::to('verify/' . $confirmationCode) }}.<br />

        </div>

    </body>
</html>