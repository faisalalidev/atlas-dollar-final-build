<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2> Hi {{$data['name']}}, you have been added as portal user ! Following are your account details: </h2> <br>
    <h3>Email: </h3>
    <p>{{$data['email']}}</p>
    <h3>Password: </h3>
    <p>{{$data['password']}}</p>
</body>
</html>
