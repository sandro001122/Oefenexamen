<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Afspraak gemaakt</title>
</head>
<body>
<div>
    <h1>Afspraak gemaakt</h1>


    <p>danku voor uw afspraak met onze kapster</p>

    <ul>
        <p>Als je nog veranderingen wil maken of je afspraak wil annuleren kan dat hier</p>
        <a href="{{ route('appointment.edit', ['appointment' => $reservationId]) }}">Afspraak informatie</a>
    </ul>

    <p>Met vriendelijke groet,</p>
    <p>Kapper "Je haar zit goed"</p>
</div>
</body>
</html>
