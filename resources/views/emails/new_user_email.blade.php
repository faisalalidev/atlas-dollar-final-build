<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2> Hi Admin, {{$user->name}} have been added as portal user ! Following are the account details: </h2> <br>
<h3>Email: </h3>
<p>{{$user->email}}</p>
<h3>Store: </h3>
<p>{{$user->store->name}}</p>
<h3>Store Id: </h3>
<p>{{$user->store_id}}</p>
<h3>User Type: </h3>
<p>{{$user->user_type}}</p>
<h3>Status: </h3>
<p>{{$user->approved}}</p>
<h3>Created: </h3>
<p>{{$user->created_at}}</p>
<p><a href="{{ route(config('constants.ADMIN_PREFIX').'store_managers_edit',['id' => $user->id]) }}">To Update</a></p>
</body>
</html>
