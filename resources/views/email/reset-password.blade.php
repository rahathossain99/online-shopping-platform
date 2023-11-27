<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Email</title>
</head>
<body>
    <p>Hello! {{ $mailData['user']->name }}</p>

    <h1>You have requested to reset your password</h1>

    <p>Please,click the link given below to reset your password</p>

    <a href="{{ route('user.resetPassword',$mailData['token']) }}">Click Here</a>

</body>
</html>

