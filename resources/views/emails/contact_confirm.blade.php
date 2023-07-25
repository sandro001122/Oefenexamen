<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Contact Formulier</title>
</head>
<body>
<h1>Contact Formulier</h1>

<p>Hierbij het verzonden contact formulier</p>

<ul>
    <p>Als je nog veranderingen wil maken of je afspraak wil annuleren kan dat hier</p>
    <li>Naam: {{ $form['name']  }}</li>
    <li>Email: {{ $form['email'] }}</li>
    <li>Bericht: {{$form['message']}}</li>
</ul>

<p>Met vriendelijke groet,</p>
<p>Kapper "Je haar zit goed"</p>
</body>
</html>
