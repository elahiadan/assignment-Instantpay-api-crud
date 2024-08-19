<!DOCTYPE html>
<html>

<head>
    <title>Laravel 11 Send Email with Attachment Example</title>
</head>

<body>
    <h1>{{ $name }}</h1>

    <p>{{$email}} hello dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.</p>

    <img src="{{ $message->embed($image) }}">
    <p>Thank you</p>
</body>

</html>