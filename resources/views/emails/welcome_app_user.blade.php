<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2> Hi {{ $data['full_name'] }}, you have been registered at {{ env('APP_NAME') }} ! Following is your account verification link: </h2> <br>
<a href="{{ $data['link'] }}">{{ $data['link'] }}</a>
</body>
</html>
