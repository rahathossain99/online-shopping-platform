<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Email</title>
</head>
<body>
    <h1>You have received a contact email</h1>

    <p>Name:{{ $mailData['name'] }}</p>
    <p>Email:{{ $mailData['email'] }}</p>
    <p>Subject:{{ $mailData['subject'] }}</p>

    <p>Message:</p>
    <p>{{ $mailData['message'] }}</p>
</body>
</html>
