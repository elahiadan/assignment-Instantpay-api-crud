<!DOCTYPE html>
<html>

<head>
    <title>Board Created | Laravel 11 Send Email with Attachment Example</title>
</head>

<body>
    <h1>{{ $name }}</h1>

    <p>New board has been created</p>

    <img src="{{ $message->embed($image) }}">
    <p>Thank you</p>
</body>

</html>