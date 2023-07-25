<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Wijziging gemaakt</title>
</head>
<body>
    <h1>Wijziging gemaakt</h1>
    
    
    
    <p>Er is een wijziging met u afspraak</p>
    
    <ul>
    <p>Als je nog veranderingen wil maken of je afspraak wil annuleren kan dat hier</p>
<a href="{{ route('appointment.edit', ['appointment' => $reservationId]) }}">Afspraak informatie</a>
    </ul>
    
    <p>Met vriendelijke groet,</p>
    <p>Kapper "Je haar zit goed"</p>
</body>
</html>
