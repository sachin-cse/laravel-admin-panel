<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{ $mailData['title']}}<h1>
    <p>{!! $mailData['description'] !!} </p>

    © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
</body>
</html>